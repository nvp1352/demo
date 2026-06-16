<?php require_once __DIR__.'/config/database.php'; require_once __DIR__.'/config/helpers.php';
$cats = $pdo->query("SELECT * FROM categories ORDER BY id")->fetchAll();
$current = $_GET['cat'] ?? '';
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>SUDES Premium Fashion</title><link rel="preconnect" href="https://images.unsplash.com"><link rel="stylesheet" href="assets/css/style.css"></head><body>
<div class="topbar">Miễn phí giao hàng cho đơn từ 1.000.000₫ • Đổi size trong 7 ngày</div>
<header class="header"><div class="nav"><a class="logo" href="index.php">SUDES</a><nav class="menu"><a href="index.php">Trang chủ</a><?php foreach($cats as $c): ?><a class="<?=active($current,$c['slug'])?>" href="products.php?cat=<?=$c['slug']?>"><?=$c['name']?></a><?php endforeach; ?></nav><div class="icons"><a href="products.php">Tìm kiếm</a><a href="cart.php">Giỏ hàng (<?=cart_count()?>)</a></div></div></header>
