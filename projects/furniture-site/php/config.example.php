<?php
// php/config.example.php

// Dane do konfiguracji bazy danych (uzupełnij lokalnie w config.local.php)
$DB_HOST = 'localhost';
$DB_NAME = 'mymebel';
$DB_USER = 'YOUR_USER';
$DB_PASS = 'YOUR_PASSWORD';

// Połączenie przez PDO
$dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
