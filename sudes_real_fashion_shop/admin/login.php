<?php
session_start(); require_once '../config/database.php'; $error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $stmt=$pdo->prepare("SELECT * FROM admins WHERE username=? AND password=MD5(?)");
    $stmt->execute([$_POST['username'],$_POST['password']]);
    if($stmt->fetch()){ $_SESSION['admin']=$_POST['username']; header('Location: index.php'); exit; }
    else $error='Sai tài khoản hoặc mật khẩu';
}
?>
<!doctype html><html lang="vi"><head><meta charset="utf-8"><title>Admin Login</title><link rel="stylesheet" href="../assets/css/style.css"></head><body>
<div class="form"><h1>Admin Login</h1><?php if($error): ?><div class="notice"><?= $error ?></div><?php endif; ?>
<form method="post"><input class="input" name="username" value="admin"><input class="input" type="password" name="password" value="admin123"><button class="btn">Đăng nhập</button></form></div>
</body></html>
