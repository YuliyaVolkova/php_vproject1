<?php

//Файл содержит функции запросов к БД.
/**
 * @param object $DBH
 */
// Функция выводит список пользователей

function listCustomers(object $DBH)
{
    $listCustomers = $DBH->prepare('SELECT * FROM customers');
    $listCustomers->setFetchMode(PDO::FETCH_OBJ);
    $listCustomers->execute();
    $tableCustomersRows = '';
    while ($row = $listCustomers->fetch()) {
        $tableCustomersRows .= '<tr>
                                <td>' . $row->email . '</td>
                                <td>' . $row->name . '</td>
                                <td>' . $row->phone . '</td>
                               </tr>';
    }
    echo '<table>
           <tr><th>Email</th><th>Имя пользователя</th><th>Телефон</th></tr>'
            . $tableCustomersRows . '
          </table>';
}

/**
 * @param object $DBH
 */
// Функция выводит список заказов

function listOrders(object $DBH)
{
    $listOrders = $DBH->prepare('SELECT * FROM orders');
    $listOrders->setFetchMode(PDO::FETCH_OBJ);
    $listOrders->execute();
    $tableOrdersRows = '';
    while($row = $listOrders->fetch()) {
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
    echo '<table>
           <tr>
             <th>Id заказа</th>
             <th>Email пользователя</th>
             <th>Дата заказа</th>
             <th>Адрес доставки</th>
             <th>Тип оплаты</th>
             <th>Можно ли перезванивать</th>
             <th>Комментарии</th>
            </tr>'
            . $tableOrdersRows . '
          </table>';
}

/**
 * @param object $DBH
 * @param array $array
 * @return integer
 */
// Функция проверяет наличие пользователя в БД по его email-у

function searchCustomer(object $DBH, array $array) :int
{
    $checkCustomer = $DBH->prepare('SELECT * FROM customers WHERE email = :email');
    $checkCustomer->execute($array);
    return $checkCustomer->rowCount();
}

/**
 * @param object $DBH
 * @param array $array
 */
// Функция добавляет новые записи в таблицу пользователей

function addNewCustomer(object $DBH, array $array)
{
    $addNewCustomer = $DBH->prepare('INSERT INTO customers (email, name, phone) 
    VALUES (:email, :name, :phone)');
    $addNewCustomer->execute($array);
}

/**
 * @param object $DBH
 * @param array $array
 */
// Функция добавляет новые записи в таблицу заказов

function addNewOrder(object $DBH, array $array)
{
    $addNewOrder = $DBH->prepare('INSERT INTO orders (customeremail, dateorder, shippingaddress, typepay,
    callback, ordercomments) VALUES (:email, :time, :address, :payment, :callback, :comments)');
    $addNewOrder->execute($array);
}

/**
 * @param object $DBH
 * @param array $array
 * @return integer
 */
// Функция возвращает ID записи в таблице заказов по email-у заказчика и времени заказа

function getOrderId(object $DBH, array $array) :int
{
    $getOrderId = $DBH->prepare('SELECT orderid FROM orders WHERE customeremail= :email AND dateorder= :time');
    $getOrderId->setFetchMode(PDO::FETCH_OBJ);
    $getOrderId->execute($array);
    return $getOrderId->fetch()->orderid;
}

/**
 * @param object $DBH
 * @param array $array
 * @return integer
 */
// Функция возвращает количество заказов запрошенного пользователя по его email-у.

function getAmountOrdersOfCustomer(object $DBH, array $array) :int
{
    $getAmountOrdersOfCustomer = $DBH->prepare('SELECT orderid FROM orders WHERE customeremail= :email');
    $getAmountOrdersOfCustomer->setFetchMode(PDO::FETCH_OBJ);
    $getAmountOrdersOfCustomer->execute($array);
    return $getAmountOrdersOfCustomer->rowCount();
}
