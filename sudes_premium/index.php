<?php include 'header.php';
$featured = $pdo->query("SELECT * FROM products WHERE is_featured=1 ORDER BY id DESC LIMIT 8")->fetchAll();
$new = $pdo->query("SELECT * FROM products WHERE is_new=1 ORDER BY created_at DESC LIMIT 4")->fetchAll();
?>
<section class="hero"><div><p>NEW SEASON COLLECTION</p><h1>New Arrivals</h1><p>Thanh lịch • Tối giản • Cao cấp</p><a class="btn" href="products.php?cat=new-arrivals">Khám phá ngay</a></div></section>
<main class="container"><div class="section-title"><h2>Sản phẩm nổi bật</h2><p>Những thiết kế mới nhất dành cho phong cách hiện đại</p></div><div class="grid"><?php foreach($featured as $p): include 'product_card.php'; endforeach; ?></div></main>
<section class="container"><div class="lookbook"><img src="https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1200&q=90" alt="Lookbook"><div class="lookbook-text"><p class="muted">LOOKBOOK 2026</p><h2>Phong cách tối giản cho mọi ngày</h2><p>Thiết kế tập trung vào phom dáng, chất liệu và khả năng phối đồ linh hoạt. Dành cho khách hàng yêu thời trang thanh lịch.</p><a class="btn" href="products.php">Xem bộ sưu tập</a></div></div></section>
<section class="container"><div class="section-title"><h2>BST Mới</h2><p>Cập nhật các mẫu thời trang mới</p></div><div class="grid"><?php foreach($new as $p): include 'product_card.php'; endforeach; ?></div></section>
<?php include 'footer.php'; ?>
