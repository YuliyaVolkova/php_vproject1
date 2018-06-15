<?php
require_once './database/db.php';
require_once './src/functions.php';

/**
 * Функция обработки данных формы заказа
 * @return array
 */
function getData()
{
    return [
        'email' => strtolower(trim($_POST['email'])),
        'name' => trim($_POST['name']),
        'phone' => trim($_POST['phone']),
        'orderTime' => date('Y-m-d H-i-s'),
        'address' => 'ул. ' . $_POST['street'] . '  д. ' . $_POST['home'] . '/' . $_POST['part'] . ' кв. ' . $_POST['appt'] . ' эт. ' . $_POST['floor'],
        'payment' => ($_POST['payment'] === 'card') ? 'КАРТОЙ' : 'НАЛИЧНЫМИ',
        'callback' => ($_POST['callback'] === 'on') ? 'НЕ ПЕРЕЗВАНИВАТЬ' : 'МОЖНО ПЕРЕЗВАНИВАТЬ',
        'comments' => trim($_POST['comment'])
        ];
}

/**
 * Функция возвращает пользователя из БД, если он существует или создает нового
 * @param string $email
 */

function checkUser(string $email)
{
    $user = searchCustomerByEmail($email);
    if($user) {
        return $user;
    }
    $data = getData();
    $newUser = [
        'email' => $data['email'],
        'name' => $data['name'],
        'phone' => $data['phone']
    ];
    return addNewCustomer($newUser);
}

/**
 * Функция отправляет письмо с данными заказа в файл ./src/mails/orders.txt
 * @param int $orderId
 * @param int $counter
 * @param string $time
 * @param string $address
 */

function sendMail(int $orderId, int $counter, string $time, string $address)
{
    $messageThank = ($counter === 1) ?
        'Спасибо - это ваш первый заказ!' : 'Спасибо! Это уже ' . $counter .' заказ';

    $order = '<h3>Заказ № ' . $orderId . '</h3>
              <div><span>Дата заказа: ' . $time . '</span></div>
              <h5>Ваш заказ будет доставлен по адресу <strong>' . $address . '</strong></h5>
              <table>
                  <tr><th>Название сета</th><th>Количество</th><th>Цена</th><th>Валюта</th></tr>
                  <tr<th>DarkBeefBurger</th><th>1</th><th>500</th><th>руб.</th></tr>
              </table>
              <h6>' . $messageThank . '</h6>
              <p>Файл записан ' . date('Y-m-d H-i-s') . "</p>".PHP_EOL;
    $mailFile = './src/mails/orders.txt';
    file_put_contents($mailFile, $order, FILE_APPEND);
}

/**
 * Основной скрипт
 */
$data = getData();
try {
    $dbh->beginTransaction();
    $dataOrder = [
        'userId' => checkUser($data['email'])->id,
        'dateOrder' => $data['orderTime'],
        'shippingAddress' => $data['address'],
        'typePayment' => $data['payment'],
        'callback' => $data['callback'],
        'comments' => $data['comments']
    ];
    $newOrder = addNewOrder($dataOrder);
    $dbh->commit();
    echo 'ok';
} catch (Exception $e) {
    $dbh->rollBack();
    $file = './src/logs/error.txt';
    file_put_contents($file, $e->getMessage(), FILE_APPEND);
}
$counter = getCounterOrdersByUserId($dataOrder['userId']);
sendMail($newOrder->id, $counter, $dataOrder['dateOrder'], $dataOrder['shippingAddress']);
