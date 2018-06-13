<?php
require_once ('./config.php');
$dsh = "mysql:host=$db_hostname;dbname=$db_database;charset=utf8";
try {
    $DBH = new PDO($dsh, $db_username, $db_password);
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(PDOException $e) {
    $errLogFile = './src/logs/PDOErrors.txt';
    file_put_contents($errLogFile, $e->getMessage(), FILE_APPEND);
}