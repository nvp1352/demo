<?php require 'auth.php'; require_once '../config/database.php';
$cats=$pdo->query("SELECT * FROM categories")->fetchAll();
if($_SERVER['REQUEST_METHOD']==='POST'){
    $slug=strtolower(trim(preg_replace('/[^a-z0-9]+/','-', iconv('UTF-8','ASCII//TRANSLIT',$_POST['name'])),'-'));
    $sale=$_POST['sale_price']!==''?$_POST['sale_price']:null;
    $stmt=$pdo->prepare("INSERT INTO products(category_id,name,slug,price,sale_price,image,second_image,description,material,sizes,is_new,is_sale) VALUES(?,?,?,?,?,?,?,?,?,?,1,?)");
    $stmt->execute([$_POST['category_id'],$_POST['name'],$slug,$_POST['price'],$sale,$_POST['image'],$_POST['second_image'],$_POST['description'],$_POST['material'],$_POST['sizes'],$sale?1:0]);
    header('Location: products.php'); exit;
}
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Thêm sản phẩm</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="form"><h1>Thêm sản phẩm</h1><form method="post">
<select class="input" name="category_id"><?php foreach($cats as $c): ?><option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['name']) ?></option><?php endforeach; ?></select>
<input class="input" name="name" placeholder="Tên sản phẩm" required><input class="input" name="price" placeholder="Giá" required><input class="input" name="sale_price" placeholder="Giá sale">
<input class="input" name="image" placeholder="Link ảnh chính" required><input class="input" name="second_image" placeholder="Link ảnh phụ">
<input class="input" name="material" placeholder="Chất liệu"><input class="input" name="sizes" value="S,M,L,XL"><textarea class="input" name="description" placeholder="Mô tả"></textarea><button class="btn">Lưu</button>
</form></div></body></html>
