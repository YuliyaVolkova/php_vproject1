<?php
require_once 'login.php';
$dsh = "mysql:host=$db_hostname;dbname=$db_database;charset=utf8";
try {
    $DBH = new PDO($dsh, $db_username, $db_password);
    $DBH->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $checkCustomerPrepare = $DBH->prepare('SELECT * FROM customers WHERE email = :email');
    $regCustomerPrepare = $DBH->prepare('INSERT INTO customers (email, name, phone) 
    VALUES (:email, :name, :phone)');
    $newOrderPrepare = $DBH->prepare('INSERT INTO orders (customeremail, dateorder, shippingaddress, typepay,
    callback, ordercomments) VALUES (:email, :time, :address, :payment, :callback, :comments)');

    $newOrderWritten = $DBH->prepare('SELECT orderid FROM orders WHERE customeremail= :email AND dateorder= :time');
    $newOrderWritten->setFetchMode(PDO::FETCH_OBJ);

    $requestCustomerOrders = $DBH->prepare('SELECT orderid FROM orders WHERE customeremail= :email');
    $requestCustomerOrders->setFetchMode(PDO::FETCH_OBJ);

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

    $DBH->beginTransaction();

    $checkCustomerPrepare->execute(array('email' => $dataFromRequest['email']));
    if ($checkCustomerPrepare->rowCount() === 0) {
            $regCustomerPrepare->execute($newUser);
    }
    $newOrderPrepare->execute($newOrder);

    $newOrderWritten->execute(array('email' => $dataFromRequest['email'], 'time' => $dataFromRequest['time']));
    $orderId = $newOrderWritten->fetch()->orderid;

    $requestCustomerOrders->execute(array('email' => $dataFromRequest['email']));
    $ordersCounter = $requestCustomerOrders->rowCount();

    $mesCounterOrders = ($ordersCounter === 1) ?
        'Спасибо - это ваш первый заказ' : 'Спасибо! Это уже ' . $ordersCounter .' заказ';

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
                <p>Файл записан ' . date('Y-m-d H-i-s') . "</p>\n";
    $mailFile = './mails/orders.txt';
    file_put_contents($mailFile, $order, FILE_APPEND);
    $DBH->commit();
    $DBH = NULL;
    echo 'ok';
} catch(PDOException $e) {
    $errLogFile = './logs/PDOErrors.txt';
    file_put_contents($errLogFile, $e->getMessage(), FILE_APPEND);
}
