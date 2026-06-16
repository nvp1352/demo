<?php
$host = '192.168.1.18';      // đổi thành localhost nếu MySQL cùng máy Apache
$dbname = 'sudes_shop';
$username = 'fashion';
$password = '123456';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Lỗi kết nối database: " . $e->getMessage());
}
?>
