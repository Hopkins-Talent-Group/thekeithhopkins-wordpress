<?php
/**
 * Redirect grow.thekeithhopkins.com → thekeithhopkins.com/fillmypipeline/
 */
$target = 'https://thekeithhopkins.com/fillmypipeline/';

// Preserve query string if present (e.g. ?submitted=1)
if ( ! empty( $_SERVER['QUERY_STRING'] ) ) {
    $target .= '?' . $_SERVER['QUERY_STRING'];
}

header( 'Location: ' . $target, true, 301 );
exit;