<?php

$connect = new PDO("mysql:host=localhost;dbname=form", 'root', '', [
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);

if (!$connect) {
    die('Нет подключения к базе данных');
}