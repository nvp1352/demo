<?php require 'auth.php'; require_once '../config/database.php'; $pdo->prepare('DELETE FROM products WHERE id=?')->execute([(int)($_GET['id']??0)]); header('Location: products.php'); ?>
