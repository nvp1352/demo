<?php include 'header.php';
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['product_id'])) {
    $id = (int)$_POST['product_id'];
    $qty = max(1, (int)($_POST['quantity'] ?? 1));
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
    header("Location: cart.php"); exit;
}
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][(int)$_GET['remove']]);
    header("Location: cart.php"); exit;
}
$items = []; $total = 0;
if (!empty($_SESSION['cart'])) {
    $ids = array_keys($_SESSION['cart']);
    $in = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id IN ($in)");
    $stmt->execute($ids);
    foreach($stmt->fetchAll() as $p) {
        $qty = $_SESSION['cart'][$p['id']];
        $price = $p['sale_price'] ?: $p['price'];
        $sum = $price * $qty;
        $total += $sum;
        $items[] = [$p,$qty,$price,$sum];
    }
}
?>
<section class="section">
<h1>Giỏ hàng</h1>
<table class="table">
<tr><th>Sản phẩm</th><th>Giá</th><th>SL</th><th>Tổng</th><th></th></tr>
<?php foreach($items as [$p,$qty,$price,$sum]): ?>
<tr>
<td><?= htmlspecialchars($p['name']) ?></td>
<td><?= number_format($price) ?>đ</td>
<td><?= $qty ?></td>
<td><?= number_format($sum) ?>đ</td>
<td><a href="cart.php?remove=<?= $p['id'] ?>">Xóa</a></td>
</tr>
<?php endforeach; ?>
</table>
<h2>Tổng: <?= number_format($total) ?>đ</h2>
<a class="btn" href="checkout.php">Thanh toán</a>
</section>
<?php include 'footer.php'; ?>
