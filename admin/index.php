<?php require 'auth.php'; require_once '../config/database.php';
$p=$pdo->query("SELECT COUNT(*) c FROM products")->fetch()['c']; $o=$pdo->query("SELECT COUNT(*) c FROM orders")->fetch()['c'];
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Admin</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="admin-wrap"><h1>Quản trị Sudes Shop</h1><div class="admin-nav"><a class="btn" href="products.php">Sản phẩm</a><a class="btn" href="orders.php">Đơn hàng</a><a class="btn" href="logout.php">Đăng xuất</a></div><p>Sản phẩm: <b><?= $p ?></b></p><p>Đơn hàng: <b><?= $o ?></b></p></div></body></html>
