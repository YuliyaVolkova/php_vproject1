<?php
require_once ('./config.php');
$dsh = "mysql:host=$dbHostname;dbname=$dbDatabase;charset=utf8";
$dbh = new PDO($dsh, $dbUsername, $dbPassword);
$dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
