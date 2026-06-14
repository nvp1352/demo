<?php
$host = 'localhost';
$dbname = 'sudes_shop';
$username = 'root';
$password = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
} catch (PDOException $e) {
    die('Lỗi kết nối database: ' . $e->getMessage());
}
function money_vnd($n){ return number_format((float)$n,0,',','.') . 'đ'; }
function current_price($p){ return $p['sale_price'] ?: $p['regular_price']; }
?>
