<?php

//Файл содержит функции запросов к БД.

/**
 * Функция выводит список пользователей
 * @return array
 */
function listCustomers()
{
    global $dbh;
    $sql = 'SELECT * FROM users WHERE 1';

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

/**
 * Функция выводит список заказов
 * @return array
 */
function listOrders()
{
    global $dbh;
    $sql = 'SELECT * FROM orders WHERE 1';

    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

/**
 * Функция возвращает запись о пользователе в БД по его email-у
 * @param string $email
 */

function searchCustomerByEmail(string $email)
{
    global $dbh;
    $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";

    $stmt = $dbh->prepare($sql);
    $stmt->execute(['email' => $email]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

/**
 * Функция добавляет новую запись в таблицу пользователей
 * @param array $array
 */

function addNewCustomer(array $array)
{
    global $dbh;
    $sql = 'INSERT INTO users (email, name, phone) VALUES (:email, :name, :phone)';

    $stmt = $dbh->prepare($sql);
    $stmt->execute($array);
    return searchCustomerByEmail($array['email']);
}

/**
 * Функция добавляет новую запись в таблицу заказов
 * @param array $array
 */

function addNewOrder(array $array)
{
    global $dbh;
    $sql = 'INSERT INTO orders (userId, dateOrder, shippingAddress, typePayment, callback, comments)
    VALUES (:userId, :dateOrder, :shippingAddress, :typePayment, :callback, :comments)';

    $stmt = $dbh->prepare($sql);
    $stmt->execute($array);
    return getLastRecordByUserId($array['userId']);
}

/**
 * Функция возвращает последнюю запись пользователя в таблице заказов по его Id
 * @param int $userId
 */

function getLastRecordByUserId($userId)
{
    global $dbh;
    $sql = 'SELECT * FROM orders WHERE userId = :userId ORDER BY id DESC LIMIT 1';

    $stmt = $dbh->prepare($sql);
    $stmt->execute(['userId' => $userId]);
    return $stmt->fetch(PDO::FETCH_OBJ);
}

/**
 * Функция возвращает счетчик заказов пользователя по его Id
 * @param int $userId
 */

function getCounterOrdersByUserId( int $userId)
{
    global $dbh;
    $sql = 'SELECT * FROM orders WHERE userId = :userId';

    $stmt = $dbh->prepare($sql);
    $stmt->execute(['userId' => $userId]);
    return $stmt->rowCount();
}
