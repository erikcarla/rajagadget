<?php foreach($produk as $item): ?>
    <div class="image-section">
        <div class="image-wrap">
            <div class="image-iner">
                <?php if(@$item->thumb == ''): ?>
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
            </div>
        </div>
        <div class="thumb-wrap">
            <?php foreach($item->picture as $key=>$pic): ?>
                <img src="<?php echo base_url().$pic['thumb']; ?>" width="40px" />
            <?php endforeach; ?>
        </div>
    </div>
    <div class="desc-section">
        <div class="produk-name">
            <h2><?php echo $item->nama_produk;?></h2>
        </div>
        <div class="produk-deskripsi">
            <p>
            <?php echo $item->deskripsi_produk;?>
            </p>
        </div>
        <div class="meta-produk">
            
            <?php if($item->harga_baru != 0): ?>
                <div class="harga-lama">
                    <span class="harga">Harga Lama</span>Rp. <?php echo $item->harga_jual ?>
                </div>
                <div class="harga-jual">
                    <span class="harga">Harga Discount</span>Rp. <?php echo $item->harga_baru ?>
                </div>
            <?php else: ?>
                <div class="harga-jual">
                    <span class="harga">Harga</span>Rp. <?php echo $item->harga_jual ?>
                </div>
            <?php endif; ?>
        </div>
        <?php if ($item->stok != 0): ?>
        <div class="button-wrap">
        <?php 
        echo form_open(site_url('store/add_cart'));
        echo form_hidden('id',$item->id_produk);
        echo form_hidden('kode',$item->kode_produk);
        echo form_hidden('name',$item->nama_produk);
        echo form_hidden('url',uri_string());
        if($item->harga_baru != 0){
            echo form_hidden('price',$item->harga_baru);
        } else {
            echo form_hidden('price',$item->harga_jual);
        }
        echo form_label('Quantity');
        echo form_input('qty','1');
        echo form_submit('submit','Add to Cart');
        echo form_close();
        ?>
        </div>
        <?php endif; ?>
    </div>
<?php endforeach; ?>