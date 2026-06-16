<?php include 'header.php';
$where=[];$params=[];
if(!empty($_GET['cat'])){ $where[]='c.slug=?'; $params[]=$_GET['cat']; }
if(!empty($_GET['q'])){ $where[]='p.name LIKE ?'; $params[]='%'.$_GET['q'].'%'; }
if(!empty($_GET['price'])){ if($_GET['price']=='1') $where[]='COALESCE(p.sale_price,p.regular_price)<700000'; if($_GET['price']=='2') $where[]='COALESCE(p.sale_price,p.regular_price) BETWEEN 700000 AND 1500000'; if($_GET['price']=='3') $where[]='COALESCE(p.sale_price,p.regular_price)>1500000'; }
$sql='SELECT p.*, c.name category_name FROM products p LEFT JOIN categories c ON p.category_id=c.id';
if($where) $sql.=' WHERE '.implode(' AND ',$where);
$sql.=' ORDER BY p.created_at DESC';
$stmt=$pdo->prepare($sql);$stmt->execute($params);$products=$stmt->fetchAll();
?>
<main class="container"><div class="section-title"><h2><?=!empty($_GET['cat']) ? htmlspecialchars($_GET['cat']) : 'Tất cả sản phẩm'?></h2><p>Lọc sản phẩm theo danh mục và khoảng giá</p></div><div class="catalog"><aside class="filter"><h3>Danh mục</h3><a href="products.php">Tất cả</a><?php foreach($cats as $c): ?><a href="products.php?cat=<?=$c['slug']?>"><?=$c['name']?></a><?php endforeach; ?><h3>Khoảng giá</h3><a href="products.php?price=1">Dưới 700.000₫</a><a href="products.php?price=2">700.000₫ - 1.500.000₫</a><a href="products.php?price=3">Trên 1.500.000₫</a><form method="get"><input name="q" placeholder="Tìm sản phẩm..."><button class="btn">Tìm</button></form></aside><section><div class="grid"><?php foreach($products as $p): include 'product_card.php'; endforeach; ?></div></section></div></main>
<?php include 'footer.php'; ?>
