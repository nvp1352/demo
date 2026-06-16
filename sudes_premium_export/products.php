<?php include 'header.php';
$where=[];$params=[];$title='Tất cả sản phẩm';
if(!empty($_GET['category'])){ $st=$pdo->prepare('SELECT * FROM categories WHERE slug=?'); $st->execute([$_GET['category']]); $cat=$st->fetch(); if($cat){$title=$cat['name']; if($cat['slug']==='sale'){$where[]='is_sale=1';} else {$where[]='category_id=?';$params[]=$cat['id'];}}}
if(!empty($_GET['q'])){$where[]='name LIKE ?';$params[]='%'.$_GET['q'].'%';}
$sql='SELECT * FROM products'.($where?' WHERE '.implode(' AND ',$where):'').' ORDER BY id DESC'; $st=$pdo->prepare($sql);$st->execute($params);$products=$st->fetchAll(); ?>
<div class="category-banner"><h1><?=$title?></h1></div><section class="section"><form class="filters"><input name="q" placeholder="Tìm sản phẩm" value="<?=htmlspecialchars($_GET['q']??'')?>"><button class="btn">Tìm kiếm</button></form><div class="grid">
<?php foreach($products as $p): ?><a class="card" href="product.php?id=<?=$p['id']?>"><div class="image-wrap"><?php if($p['is_sale']): ?><span class="badge">SALE</span><?php endif; ?><img class="main" src="<?=$p['image']?>"><img class="hover" src="<?=$p['hover_image']?:$p['image']?>"></div><div class="info"><div class="name"><?=$p['name']?></div><div class="price"><?php if($p['sale_price']): ?><span class="old"><?=money($p['price'])?></span><span class="sale"><?=money($p['sale_price'])?></span><?php else: ?><span><?=money($p['price'])?></span><?php endif; ?></div></div></a><?php endforeach; ?>
</div></section><?php include 'footer.php'; ?>
