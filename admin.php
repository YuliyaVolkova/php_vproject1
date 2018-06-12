<?php
require_once './data/login.php';

ob_start();

$dsh = "mysql:host=$db_hostname;dbname=$db_database;charset=utf8";
try {
    $DBH = new PDO($dsh, $db_username, $db_password);
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $listCustomersPrepare = $DBH->prepare('SELECT * FROM customers');
    $listCustomersPrepare->setFetchMode(PDO::FETCH_OBJ);
    $listOrdersPrepare = $DBH->prepare('SELECT * FROM orders');
    $listOrdersPrepare->setFetchMode(PDO::FETCH_OBJ);

    // Таблица пользователей
    echo "<div class='task-wrapper'>";
    echo '<h2>Список всех зарегистрированных пользователей:</h2>';

    $listCustomersPrepare->execute();
    $tableCustomersRows = '';
    while ($row = $listCustomersPrepare->fetch()) {
        $tableCustomersRows .= '<tr>
                                <td>' . $row->email . '</td>
                                <td>' . $row->name . '</td>
                                <td>' . $row->phone . '</td>
                               </tr>';
    }
    $customersTable = '<table>
                        <tr>
                            <th>Email</th>
                            <th>Имя пользователя</th>
                            <th>Телефон</th>
                        </tr>' . $tableCustomersRows . '
                       </table>';
    echo $customersTable;

    echo '</div>';

    // Таблица заказов
    echo "<div class='task-wrapper'>";
    echo '<h2>Список всех заказов:</h2>';

    $listOrdersPrepare->execute();
    $tableOrdersRows = '';
    while($row = $listOrdersPrepare->fetch()) {
        $tableOrdersRows .= '<tr>
                                <td>' . $row->orderid . '</td>
                                <td>' . $row->customeremail . '</td>
                                <td>' . $row->dateorder . '</td>
                                <td>' . $row->shippingaddress . '</td>
                                <td>' . $row->typepay . '</td>
                                <td>' . $row->callback . '</td>
                                <td>' . $row->ordercomments . '</td>
                              </tr>';
    }

    $DBH = NULL;

    $ordersTable = '<table>
                        <tr>
                            <th>Id заказа</th>
                            <th>Email пользователя</th>
                            <th>Дата заказа</th>
                            <th>Адрес доставки</th>
                            <th>Тип оплаты</th>
                            <th>Можно ли перезванивать</th>
                            <th>Комментарии</th>
                        </tr>' . $tableOrdersRows . '
                       </table>';
    echo $ordersTable;
    echo '</div>';
} catch(PDOException $e) {
    $errLogFile = './data/logs/PDOErrors.txt';
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
    <link rel="stylesheet" href="./css/styles.css">
    <title>Первый выпускной проект от loftschool.com</title>
</head>
<body>
<div class="container">
    <h1 class="title">Административная панель</h1>
    <?= $content ?>
</div>
</body>
</html>
