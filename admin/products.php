<?php require 'auth.php'; require_once '../config/database.php';
$products=$pdo->query("SELECT p.*,c.name category FROM products p LEFT JOIN categories c ON p.category_id=c.id ORDER BY p.id DESC")->fetchAll();
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Sản phẩm</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="admin-wrap"><h1>Quản lý sản phẩm</h1><div class="admin-nav"><a class="btn" href="index.php">Dashboard</a><a class="btn" href="product_add.php">Thêm sản phẩm</a></div>
<table class="table"><tr><th>ID</th><th>Tên</th><th>Danh mục</th><th>Giá</th><th>Sale</th><th></th></tr>
<?php foreach($products as $p): ?><tr><td><?= $p['id'] ?></td><td><?= htmlspecialchars($p['name']) ?></td><td><?= htmlspecialchars($p['category']) ?></td><td><?= number_format($p['price']) ?>đ</td><td><?= $p['sale_price'] ? number_format($p['sale_price']).'đ' : '-' ?></td><td><a href="product_delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a></td></tr><?php endforeach; ?>
</table></div></body></html>
