<h1><?php echo $judul ?></h1>
<div id="menu" class="box">
	<ul class="box f-right">
	   <li><a href="<?php echo site_url('admin/produk/tambah') ?>" id="add">
       <span><strong>Tambah Produk Baru</strong></span>
       </a></li>
    </ul>
</div>
<h3 class="tit"><?php echo $nama_produk; ?></h3>

<div class="detil-left">
    <div class="picture-wrap">
        <div class="picture-inner">
        <?php if(@$gambar): ?>
        
            <?php $i=true; foreach(@$gambar as $item): ?>
            <?php if(@$item->default): ?>
                <?php $i=false; ?>
                <a href="<?php echo base_url().@$item->image; ?>" class="image-thumb" >
                <img src="<?php echo base_url().@$item->thumb; ?>" />
                </a>
            <?php endif;?>
            <?php endforeach; ?>
            
            <?php if ($i): ?>
                <div class="no-image"><span>
                <a href="<?php echo site_url('admin/produk/gambar/'.$id); ?>">No Default Picture</a>
                </span></div>
            <?php endif; ?>
            
            <?php foreach(@$gambar as $item): ?>
            <?php if(!@$item->default): ?>
                <a href="<?php echo base_url().@$item->image; ?>" class="image-thumb" >
                <img src="<?php echo base_url().@$item->thumb; ?>" width="30px" />
                </a>
            <?php endif;?>
            <?php endforeach; ?>
            
            <br />
            <a href="<?php echo site_url('admin/produk/gambar/'.$id); ?>">Tambah Gambar</a>
            
        <?php else: ?>
        
            <div class="no-image"><span>
            <a href="<?php echo site_url('admin/produk/gambar/'.$id); ?>">Tambah Gambar</a>
            </span></div>
            
        <?php endif; ?>
        </div>
    </div>
</div>
<div class="detil-right">

<?php 
echo validation_errors();
echo form_open(site_url(uri_string()));
echo form_fieldset('Data Produk','class="produk"');
echo '<div class="col-left">';
echo form_label('Kode');
echo form_input('kode',@$kode,'class="input-text"');
echo form_label('Nama Produk');
echo form_input('nama_produk',@$nama_produk,'class="input-text"');
echo '</div><div class="col-right">';
echo form_label('Stok');
echo form_input('stok',@$stok,'class="input-text"');
echo form_label('Kategori');
echo form_dropdown('kategori',$list_kategori,@$kategori);
echo '</div><div class="clear"></div>';
echo form_fieldset_close();
echo form_fieldset('Harga','class="produk"');
echo '<div class="col-left">';
echo form_label('Harga Jual');
echo form_input('harga',@$harga,'class="input-text"');
echo '</div><div class="col-right">';
echo form_label('Harga Baru');
echo form_input('harga_baru',@$harga_baru,'class="input-text"');
echo '</div><div class="clear"></div>';
echo form_fieldset_close();
echo form_fieldset('Deskripsi','class="produk"');
echo form_textarea('deskripsi',@$deskripsi,'style="width:300px;height:100px;"');
echo form_submit('submit','Submit','class="input-submit"');

echo form_fieldset_close();
echo form_close();
?>
</div>
<div class="clear"></div>

<script type="text/javascript">
jQuery(function($) {
	$("#add").colorbox({
		width:"500", height:"500", iframe:true,
		onClosed:function(){ location.reload(); }
	});
    $(".image-thumb").colorbox();
});
</script>