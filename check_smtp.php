<?php
$host = 'smtp.gmail.com';
$port = 465;
$fp = @fsockopen($host, $port, $errno, $errstr, 10);
if ($fp) {
    echo "OK: connected to $host:$port\n";
    fclose($fp);
} else {
    echo "FAILED: $errstr ($errno)\n";
}
