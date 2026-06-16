<?php
if (session_status() === PHP_SESSION_NONE) session_start();
function money($n){ return number_format((float)$n,0,',','.').'₫'; }
function cart_count(){ return array_sum($_SESSION['cart'] ?? []); }
function product_price($p){ return $p['sale_price'] ?: $p['regular_price']; }
function active($a,$b){ return $a===$b ? 'active' : ''; }
?>
