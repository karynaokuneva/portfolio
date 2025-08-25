<?php
// Подключение к базе данных MySQL (XAMPP)
$host = 'localhost';
$dbname = 'mymebel';
$username = 'root'; // стандартный пользователь в XAMPP
$password = '';     // без пароля по умолчанию

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Включение режима ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Błąd połączenia z bazą danych: " . $e->getMessage());
}
?>
