<?php require 'auth.php'; require_once '../config/database.php'; $st=$pdo->prepare('DELETE FROM products WHERE id=?'); $st->execute([$_GET['id']]); header('Location: index.php'); ?>
