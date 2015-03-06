<?php 
if (@$sukses) {
    echo '<p class="msg done">'.@$sukses.'</p>';
    ?>
    <script type="text/javascript">
    (function($) {
    	$(function() {
    		parent.jQuery.colorbox.close();
    		return false;
    	});
    })(jQuery);
    </script>
    <?php 
}else{
    echo validation_errors();
    echo form_fieldset('Penambahan Produk','class="produk"');
    echo '<div class="col-left">';
    echo form_open(site_url(uri_string()));
    echo form_label('Kode');
    echo form_input('kode',@$kode,'class="input-text"');
    echo form_label('Nama Produk');
    echo form_input('nama_produk',@$nama_produk,'class="input-text"');
    echo form_label('Kategori');
    echo form_dropdown('kategori',$list_kategori,@$kategori);
    echo '</div><div class="col-right">';
    echo form_label('Harga');
    echo form_input('harga',@$harga,'class="input-text"');
    echo form_label('Stok');
    echo form_input('stok',@$stok,'class="input-text"');
    echo '</div><div class="clear"></div><div class="col-down">';
    echo form_label('Deskripsi');
    echo form_textarea('deskripsi',@$deskripsi,'style="width:300px;height:100px;"');
    echo form_submit('submit','Submit','class="input-submit"');
    echo form_close();
    echo '</div>';  
    echo form_fieldset_close();
}
?>