<?php
require_once './database/db.php';
require_once './src/functions.php';

$address = 'ул. ' . $_POST['street'] . '  д. ' . $_POST['home'] . '/' . $_POST['part'] . ' кв. ' . $_POST['appt'] . ' эт. ' . $_POST['floor'];
$payment = ($_POST['payment'] === 'card') ? 'КАРТОЙ' : 'НАЛИЧНЫМИ';
$callback = ($_POST['callback'] === 'on') ? 'НЕ ПЕРЕЗВАНИВАТЬ' : 'МОЖНО ПЕРЕЗВАНИВАТЬ';
$dataFromRequest = [
    'email' => $_POST['email'],
    'name' => $_POST['name'],
    'phone' => $_POST['phone'],
    'time' => date('Y-m-d H-i-s'),
    'address' => $address,
    'payment' => $payment,
    'callback' => $callback,
    'comments' => $_POST['comment']
];

$newUser = [
    'email' => $dataFromRequest['email'],
    'name' => $dataFromRequest['name'],
    'phone' => $dataFromRequest['phone']
];

$newOrder = [
    'email' => $dataFromRequest['email'],
    'time' => $dataFromRequest['time'],
    'address' => $dataFromRequest['address'],
    'payment' => $dataFromRequest['payment'],
    'callback' => $dataFromRequest['callback'],
    'comments' => $dataFromRequest['comments']
];

try {

    $dbh->beginTransaction();

    if(searchCustomer($dbh, array('email' => $dataFromRequest['email'])) === 0) {
        addNewCustomer($dbh, $newUser);
    }
    addNewOrder($dbh, $newOrder);
    $orderId = getOrderId($dbh, array('email' => $dataFromRequest['email'], 'time' => $dataFromRequest['time']));
    $ordersAmount = getAmountOrdersOfCustomer($dbh, array('email' => $dataFromRequest['email']));
    $mesCounterOrders = ($ordersAmount === 1) ?
        'Спасибо - это ваш первый заказ' : 'Спасибо! Это уже ' . $ordersAmount .' заказ';

    $order = '<h3>Заказ № ' . $orderId . '</h3>
              <div><span>Дата заказа: ' . $dataFromRequest['time'] . '</span></div>
              <h5>Ваш заказ будет доставлен по адресу <strong>' . $dataFromRequest['address'] . '</strong></h5>
               <table>
                   <tr>
                      <th>Название сета</th>
                      <th>Количество</th>
                      <th>Цена</th>
                      <th>Валюта</th>
                    </tr>
                    <tr>
                      <th>DarkBeefBurger</th>
                      <th>1</th>
                      <th>500</th>
                      <th>руб.</th>
                    </tr>
                </table>
                <h6>' . $mesCounterOrders . '</h6>
                <p>Файл записан ' . date('Y-m-d H-i-s') . "</p>".PHP_EOL;
    $mailFile = './src/mails/orders.txt';
    file_put_contents($mailFile, $order, FILE_APPEND);
    $dbh->commit();
    echo 'ok';
} catch(PDOException $e) {
    $errLogFile = './src/logs/PDOErrors.txt';
    file_put_contents($errLogFile, $e->getMessage(), FILE_APPEND);
}
