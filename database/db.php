<?php
require_once ('./config.php');
$dsh = "mysql:host=$dbHostname;dbname=$dbDatabase;charset=utf8";
try {
    $dbh = new PDO($dsh, $dbUsername, $dbPassword);
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch(PDOException $e) {
    $errLogFile = './src/logs/PDOErrors.txt';
    file_put_contents($errLogFile, $e->getMessage(), FILE_APPEND);
}