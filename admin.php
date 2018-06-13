<?php
require_once './database/db.php';
require_once './src/functions.php';

ob_start();

try {

    // Таблица пользователей

    echo '<div class="task-wrapper"><h2>Список всех зарегистрированных пользователей:</h2>',
    listCustomers($DBH), '</div>';

    // Таблица заказов

    echo '<div class="task-wrapper"><h2>Список всех заказов:</h2>', listOrders($DBH), '</div>';

} catch(PDOException $e) {
    $errLogFile = './src/logs/PDOErrors.txt';
    file_put_contents($errLogFile, $e->getMessage(), FILE_APPEND);
}

$content = ob_get_contents();
ob_end_clean();

?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./public/css/styles.css">
    <title>Первый выпускной проект от loftschool.com</title>
</head>
<body>
<div class="container">
    <h1 class="title">Административная панель</h1>
    <?= $content ?>
</div>
</body>
</html>
