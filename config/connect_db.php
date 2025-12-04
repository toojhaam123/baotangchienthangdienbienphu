<?php
function getConnection()
{
    $host = 'localhost';
    $database = 'baotangdienbien';
    $username = 'root';
    $password = '';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$database;", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Không thể kết nối được cơ sở dữ liệu: " . $e->getMessage());
    }
}
