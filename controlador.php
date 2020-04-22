<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'config/config.php';

$_SESSION['DBServer1'] = $_DBServer;
$_SESSION['DBUser1'] = $_DBUser;
$_SESSION['DBPwd1'] = $_DBPwd;
$_SESSION['DBName1'] = $_DBName;