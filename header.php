<?php
if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/config/database.php';
$cats = $pdo->query("SELECT * FROM categories ORDER BY id")->fetchAll();
$count = 0;
if (!empty($_SESSION['cart'])) foreach($_SESSION['cart'] as $q) $count += $q;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Sudes Premium Fashion</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="topbar">Ưu đãi New Arrivals - Miễn phí giao hàng cho đơn từ 999.000đ</div>
<header class="nav">
  <a class="logo" href="index.php">SUDES</a>
  <nav class="menu">
    <?php foreach($cats as $c): ?>
      <a href="products.php?cat=<?= htmlspecialchars($c['slug']) ?>"><?= htmlspecialchars($c['name']) ?></a>
    <?php endforeach; ?>
  </nav>
  <div class="icons">
    <a href="cart.php">Giỏ hàng (<?= $count ?>)</a>
    <a href="admin/login.php">Admin</a>
  </div>
</header>
