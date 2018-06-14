<?php
require_once './database/db.php';
require_once './src/functions.php';

$email = strtolower(trim($_POST['email']));
$name = trim($_POST['name']);
$phone = trim($_POST['phone']);
$orderTime = date('Y-m-d H-i-s');
$address = 'ул. ' . $_POST['street'] . '  д. ' . $_POST['home'] . '/' . $_POST['part'] . ' кв. ' . $_POST['appt'] . ' эт. ' . $_POST['floor'];
$payment = ($_POST['payment'] === 'card') ? 'КАРТОЙ' : 'НАЛИЧНЫМИ';
$callback = ($_POST['callback'] === 'on') ? 'НЕ ПЕРЕЗВАНИВАТЬ' : 'МОЖНО ПЕРЕЗВАНИВАТЬ';
$comments = trim($_POST['comment']);

$dbh->beginTransaction();
$user = searchCustomerByEmail($email);
if (!$user) {
    $newUser = [
        'email' => $email,
        'name' => $name,
        'phone' => $phone
    ];
    $user = addNewCustomer($newUser);
}
$userId = $user->id;
$newOrder = [
    'userId' => $userId,
    'dateOrder' => $orderTime,
    'shippingAddress' => $address,
    'typePayment' => $payment,
    'callback' => $callback,
    'comments' => $comments
];

    $newOrder = addNewOrder($newOrder);
    $newOrderId = $newOrder->id;
    $ordersCounter = getCounterOrdersByUserId($userId);
    $mesCounterOrders = ($ordersCounter === 1) ?
        'Спасибо - это ваш первый заказ!' : 'Спасибо! Это уже ' . $ordersCounter .' заказ';

    $order = '<h3>Заказ № ' . $newOrderId . '</h3>
              <div><span>Дата заказа: ' . $orderTime . '</span></div>
              <h5>Ваш заказ будет доставлен по адресу <strong>' . $address . '</strong></h5>
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
