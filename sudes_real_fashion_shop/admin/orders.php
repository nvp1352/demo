<?php require 'auth.php'; require_once '../config/database.php'; $orders=$pdo->query("SELECT * FROM orders ORDER BY id DESC")->fetchAll(); ?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Đơn hàng</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="admin-wrap"><h1>Đơn hàng</h1><a class="btn" href="index.php">Dashboard</a><table class="table"><tr><th>ID</th><th>Khách hàng</th><th>SĐT</th><th>Địa chỉ</th><th>Tổng</th><th>Ngày</th></tr>
<?php foreach($orders as $o): ?><tr><td><?= $o['id'] ?></td><td><?= htmlspecialchars($o['customer_name']) ?></td><td><?= htmlspecialchars($o['phone']) ?></td><td><?= htmlspecialchars($o['address']) ?></td><td><?= number_format($o['total']) ?>đ</td><td><?= $o['created_at'] ?></td></tr><?php endforeach; ?>
</table></div></body></html>
