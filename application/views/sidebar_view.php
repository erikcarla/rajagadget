
<li>
<h2>Shopping Cart</h2>
<?php if($cart == array()): ?>
    <div class="note-cart">Your Cart is Empty</div>
<?php else: ?>
    <ul>
    <?php foreach($cart as $item): ?>
    <li><?php echo $item['name']." (".$item['qty'].")"; ?></li>
    <?php endforeach; ?>
    </ul>
    <a href="<?php echo site_url('store/hapus_cart'); ?>" class="clear">Hapus Isi</a>
    <a href="<?php echo site_url('store/checkout'); ?>" class="checkout">Check Out</a>
<?php endif; ?>
</li>
<li>
<h2>Category</h2>
<?php echo $kategori; ?>
</li>
   
      