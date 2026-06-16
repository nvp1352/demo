<?php include 'header.php';
$where = "";
$params = [];
$title = "Tất cả sản phẩm";
if (!empty($_GET['cat'])) {
    $where = "WHERE c.slug = ?";
    $params[] = $_GET['cat'];
    $stmtCat = $pdo->prepare("SELECT name FROM categories WHERE slug=?");
    $stmtCat->execute([$_GET['cat']]);
    $title = $stmtCat->fetchColumn() ?: $title;
}
$stmt = $pdo->prepare("SELECT p.*, c.name category_name FROM products p LEFT JOIN categories c ON p.category_id=c.id $where ORDER BY p.id DESC");
$stmt->execute($params);
$products = $stmt->fetchAll();
?>
<section class="section">
  <h1 class="section-title"><?= htmlspecialchars($title) ?></h1>
  <div class="grid">
    <?php foreach($products as $p): ?>
    <div class="card">
      <?php if($p['is_sale']): ?><span class="badge">SALE</span><?php endif; ?>
      <a href="product.php?slug=<?= $p['slug'] ?>">
        <div class="imgbox">
          <img class="first" src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
          <img class="second" src="<?= htmlspecialchars($p['second_image'] ?: $p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>">
        </div>
        <div class="pname"><?= htmlspecialchars($p['name']) ?></div>
        <div class="price">
          <?php if($p['sale_price']): ?><span class="old"><?= number_format($p['price']) ?>đ</span><span class="sale"><?= number_format($p['sale_price']) ?>đ</span>
          <?php else: ?><?= number_format($p['price']) ?>đ<?php endif; ?>
        </div>
      </a>
    </div>
    <?php endforeach; ?>
  </div>
</section>
<?php include 'footer.php'; ?>
