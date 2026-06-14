<article class="card">
  <a href="product.php?slug=<?=htmlspecialchars($p['slug'])?>"><img src="<?=htmlspecialchars($p['image'])?>" alt="<?=htmlspecialchars($p['name'])?>"></a>
  <div class="badges"><?php if($p['is_sale']): ?><span>Sale</span><?php endif; ?><?php if($p['is_new']): ?><span>New</span><?php endif; ?></div>
  <h3><a href="product.php?slug=<?=htmlspecialchars($p['slug'])?>"><?=htmlspecialchars($p['name'])?></a></h3>
  <p class="colors"><?=htmlspecialchars($p['colors'])?></p>
  <div class="price"><?php if($p['sale_price']): ?><del><?=money_vnd($p['regular_price'])?></del> <strong><?=money_vnd($p['sale_price'])?></strong><?php else: ?><strong><?=money_vnd($p['regular_price'])?></strong><?php endif; ?></div>
  <a class="mini-btn" href="cart.php?action=add&id=<?=$p['id']?>">Thêm vào giỏ</a>
</article>
