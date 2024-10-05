<?php
require_once __DIR__ . '/autoload.php';
$auth->logout();
header("location:index");
die;