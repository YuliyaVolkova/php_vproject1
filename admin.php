<?php
require_once './database/db.php';
require_once './src/functions.php';

$listCustomers = listCustomers();
$listOrders = listOrders();
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
    <div class="task-wrapper">
        <h2>Список всех зарегистрированных пользователей:</h2>
        <table>
            <tr>
                <th>Id пользователя</th>
                <th>Email</th>
                <th>Имя пользователя</th>
                <th>Телефон</th>
            </tr>
            <?php foreach($listCustomers as $value) : ?>
                <tr>
                    <td><?= $value->id ?></td>
                    <td><?= $value->email ?></td>
                    <td><?= $value->name  ?></td>
                    <td><?= $value->phone ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="task-wrapper">
        <h2>Список всех заказов:</h2>
        <table>
            <tr>
                <th>Id заказа</th>
                <th>Id пользователя</th>
                <th>Дата заказа</th>
                <th>Адрес доставки</th>
                <th>Тип оплаты</th>
                <th>Можно ли перезванивать</th>
                <th>Комментарии</th>
            </tr>
            <?php foreach($listOrders as $value) : ?>
                <tr>
                    <td><?= $value->id ?></td>
                    <td><?= $value->userId  ?></td>
                    <td><?= $value->dateOrder ?></td>
                    <td><?= $value->shippingAddress ?></td>
                    <td><?= $value->typePayment ?></td>
                    <td><?= $value->callback ?></td>
                    <td><?= $value->comments ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
</body>
</html>
