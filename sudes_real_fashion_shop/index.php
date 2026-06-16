<?php include 'header.php'; ?>
<section class="hero">
  <div>
    <h1>NEW ARRIVALS</h1>
    <p>Luxury minimal fashion for everyday elegance.</p>
    <a class="btn light" href="products.php">Khám phá ngay</a>
  </div>
</section>

<section class="section">
  <h2 class="section-title">Danh mục nổi bật</h2>
  <div class="home-cats">
    <a class="cat-tile" href="products.php?cat=women"><img src="https://images.unsplash.com/photo-1485968579580-b6d095142e6e?auto=format&fit=crop&w=900&q=90"><div><h3>Women</h3><span>Shop now</span></div></a>
    <a class="cat-tile" href="products.php?cat=men"><img src="https://images.unsplash.com/photo-1520975916090-3105956dac38?auto=format&fit=crop&w=900&q=90"><div><h3>Men</h3><span>Shop now</span></div></a>
    <a class="cat-tile" href="products.php?cat=accessories"><img src="https://images.unsplash.com/photo-1594223274512-ad4803739b7c?auto=format&fit=crop&w=900&q=90"><div><h3>Accessories</h3><span>Shop now</span></div></a>
  </div>
</section>

<section class="section">
  <h2 class="section-title">Sản phẩm mới</h2>
  <p class="sub">Ảnh sản phẩm là ảnh thời trang thật từ Unsplash, không dùng placeholder.</p>
  <div class="grid">
    <?php
    $products = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 8")->fetchAll();
    foreach($products as $p):
    ?>
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

<section class="split">
  <div class="split-img"></div>
  <div class="split-txt">
    <h2>Minimal Luxury</h2>
    <p>Thiết kế tối giản, hình ảnh lớn, grid sản phẩm rõ ràng và trải nghiệm mua hàng giống một website thời trang thật.</p>
    <a class="btn" href="products.php">Xem bộ sưu tập</a>
  </div>
</section>
<?php include 'footer.php'; ?>
