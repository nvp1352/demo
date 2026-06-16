<?php include 'header.php';
$total = 0; $products = [];
if (!empty($_SESSION['cart'])) {
    $ids = array_keys($_SESSION['cart']);
    $in = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($in)");
    $stmt->execute($ids);
    $products = $stmt->fetchAll();
    foreach($products as $p) $total += ($p['sale_price'] ?: $p['price']) * $_SESSION['cart'][$p['id']];
}
$success = false;
if ($_SERVER['REQUEST_METHOD']==='POST' && $products) {
    $stmt = $pdo->prepare("INSERT INTO orders(customer_name,phone,address,note,total) VALUES(?,?,?,?,?)");
    $stmt->execute([$_POST['customer_name'], $_POST['phone'], $_POST['address'], $_POST['note'] ?? '', $total]);
    $order_id = $pdo->lastInsertId();
    foreach($products as $p) {
        $price = $p['sale_price'] ?: $p['price'];
        $qty = $_SESSION['cart'][$p['id']];
        $stmt = $pdo->prepare("INSERT INTO order_items(order_id,product_id,product_name,price,quantity) VALUES(?,?,?,?,?)");
        $stmt->execute([$order_id,$p['id'],$p['name'],$price,$qty]);
    }
    $_SESSION['cart'] = [];
    $success = true;
}
?>
<section class="form">
<h1>Thanh toán</h1>
<?php if($success): ?>
<div class="notice">Đặt hàng thành công!</div>
<a class="btn" href="index.php">Về trang chủ</a>
<?php else: ?>
<form method="post">
<input class="input" name="customer_name" placeholder="Họ tên" required>
<input class="input" name="phone" placeholder="Số điện thoại" required>
<input class="input" name="address" placeholder="Địa chỉ" required>
<textarea class="input" name="note" placeholder="Ghi chú"></textarea>
<h3>Tổng đơn: <?= number_format($total) ?>đ</h3>
<button class="btn">Xác nhận đặt hàng</button>
</form>
<?php endif; ?>
</section>
<?php include 'footer.php'; ?>
