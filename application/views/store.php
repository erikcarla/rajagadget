<?php foreach($produk as $item): ?>
    <div class="produk-wrap">
        <div class="image-wrap">
            <div class="image-iner">
                <?php if($item->thumb == ''): ?>
                    <div class="no-image">
                        <span>Belum ada Gambar</span>
                    </div>
                <?php else: ?>
                    <img src="<?php echo base_url().$item->thumb ?>" />
                <?php endif; ?>
                <?php if ($item->stok == 0): ?>
                    <div class="trans">
                        <span>Stok Habis</span>
                    </div>
                <?php endif; ?>
                 <?php if ($item->harga_baru != 0): ?>
                    <div class="trans1">
                        <span><img src="<?php echo base_url().'template/template/images/shopping-cart-hot.png' ?>" width="100px" height="100px""/></span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="produk-name">
            <?php echo anchor(site_url(uri_string().'/'.$item->url_produk),$item->nama_produk);?>
        </div>
        <?php if($item->harga_baru != 0): ?>
            <div class="harga-lama">
                Rp. <?php echo $item->harga_jual ?>
            </div>
            <div class="harga-jual">
                Rp. <?php echo $item->harga_baru ?>
            </div>
        <?php else: ?>
            <div class="harga-jual">
                Rp. <?php echo $item->harga_jual ?>
            </div>
        <?php endif; ?>
    </div>
      
<?php endforeach; ?>
   <div id="category">	
<?php foreach($produk as $item): ?>
    	 <img src="<?php echo base_url().$item->thumb ?>" />    
<?php endforeach; ?>
</div>