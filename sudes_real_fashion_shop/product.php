<?php include 'header.php';
$slug = $_GET['slug'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM products WHERE slug=?");
$stmt->execute([$slug]);
$p = $stmt->fetch();
if (!$p) die("Không tìm thấy sản phẩm");
?>
<section class="product-detail">
  <div class="gallery">
    <img src="<?= htmlspecialchars($p['image']) ?>" alt="">
    <img src="<?= htmlspecialchars($p['second_image'] ?: $p['image']) ?>" alt="">
  </div>
  <div class="info">
    <h1><?= htmlspecialchars($p['name']) ?></h1>
    <div class="price">
      <?php if($p['sale_price']): ?><span class="old"><?= number_format($p['price']) ?>đ</span><span class="sale"><?= number_format($p['sale_price']) ?>đ</span>
      <?php else: ?><?= number_format($p['price']) ?>đ<?php endif; ?>
    </div>
    <p><?= htmlspecialchars($p['description']) ?></p>
    <p><b>Chất liệu:</b> <?= htmlspecialchars($p['material']) ?></p>
    <p><b>Size:</b> <?= htmlspecialchars($p['sizes']) ?></p>
    <form method="post" action="cart.php">
      <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
      <input class="input" type="number" name="quantity" value="1" min="1">
      <button class="btn" type="submit">Thêm vào giỏ</button>
    </form>
  </div>
</section>
<?php include 'footer.php'; ?>
