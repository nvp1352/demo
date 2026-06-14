<?php require 'header.php'; $products=$pdo->query("SELECT * FROM products ORDER BY created_at DESC LIMIT 8")->fetchAll(); ?>
<section class="hero"><div><p class="eyebrow">NEW ARRIVALS 2026</p><h1>Thời trang thể thao cao cấp cho mọi chuyển động</h1><p>Bộ sưu tập áo thun, polo, bra, legging và phụ kiện với chất liệu thoáng khí, co giãn 4 chiều.</p><a class="btn" href="products.php">Mua ngay</a></div></section>
<section class="section"><div class="section-head"><h2>BST mới</h2><a href="products.php">Xem tất cả</a></div><div class="grid"><?php foreach($products as $p): include 'product-card.php'; endforeach; ?></div></section>
<section class="banner"><h2>Sport Luxe Minimal</h2><p>Thiết kế sạch, sản phẩm nổi bật, trải nghiệm mua hàng nhanh.</p></section>
<?php require 'footer.php'; ?>
