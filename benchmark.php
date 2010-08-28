<?php
// Simple Microtime Benchmarking for Wordpress, using syslog

$start_time = microtime(true);

require('index.php');

$end_time = microtime(true);
syslog(LOG_INFO, 'WordPress request ended, elapsed time: '.$end_time - $start_time);
?>
