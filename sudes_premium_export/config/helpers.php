<?php
function money($v){ return number_format((int)$v, 0, ',', '.') . '₫'; }
function productPrice($p){ return $p['sale_price'] ?: $p['price']; }
function active($slug){ return (isset($_GET['category']) && $_GET['category']===$slug) ? 'active' : ''; }
?>
