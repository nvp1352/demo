<?php include 'header.php'; $products=$pdo->query('SELECT * FROM products WHERE is_new=1 ORDER BY id DESC LIMIT 8')->fetchAll(); ?>
<section class="hero"><div><h1>NEW ARRIVALS</h1><p>Bộ sưu tập thời trang tối giản, hiện đại với chất liệu cao cấp và phom dáng thanh lịch.</p><a class="btn" href="products.php?category=new-arrivals">Khám phá ngay</a></div></section>
<section class="section"><div class="section-title"><h2>Sản phẩm mới</h2><p>Lookbook mới nhất dành cho phong cách thành thị.</p></div><div class="grid">
<?php foreach($products as $p): ?><a class="card" href="product.php?id=<?=$p['id']?>"><div class="image-wrap"><?php if($p['is_sale']): ?><span class="badge">SALE</span><?php endif; ?><img class="main" src="<?=$p['image']?>"><img class="hover" src="<?=$p['hover_image']?:$p['image']?>"></div><div class="info"><div class="name"><?=$p['name']?></div><div class="price"><?php if($p['sale_price']): ?><span class="old"><?=money($p['price'])?></span><span class="sale"><?=money($p['sale_price'])?></span><?php else: ?><span><?=money($p['price'])?></span><?php endif; ?></div></div></a><?php endforeach; ?>
</div></section>
<section class="section"><div class="section-title"><h2>Premium Essentials</h2><p>Blazer, đầm, sơ mi, túi và phụ kiện cao cấp cho tủ đồ hiện đại.</p></div></section>
<?php include 'footer.php'; ?>
