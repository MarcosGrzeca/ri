<?php
define("BD", "ri3.");
define("SENHA", "");
header('Content-Type: text/html; charset=utf-8');
set_time_limit(0);
$mysqli = new mysqli("localhost", "root", SENHA, BD);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$mysqli->query("set names 'utf8'");
ob_start();
require_once('FirePHPCore/fb.php');
