<h1><?php echo $judul ?></h1>
<div id="menu" class="box">
	<ul class="box f-right">
	   <li><a href="<?php echo site_url('admin/produk/tambah') ?>" id="add">
       <span><strong>Tambah Produk Baru</strong></span>
       </a></li>
    </ul>
</div>

<h3 class="tit"><?php echo $produk->nama_produk; ?></h3>

<?php if($gambar): ?>
	<table>
		<tr>
            <th>Thumb</th>
            <th>Status</th>
            <th>Action</th>
		</tr>
        <?php $i=0; foreach ($gambar as $val): ?>
		<tr  <?php echo $i%2 == 0 ? 'class="bg"' : '';  ?> >
		    <td>
                <img src="<?php echo base_url().$val->thumb; ?>" width="45px"/>
            </td>
            <td style="vertical-align: middle;"><?php echo $val->default == 1 ? anchor(site_url(uri_string()),'Utama', 'class="active"') : anchor(site_url('admin/produk/set_default').'/'.$produk->id_produk.'/'.$val->id_foto_produk,'Tambahan', 'class="no-active"'); ?></td>
		    <td style="vertical-align: middle;">
                <?php echo anchor(site_url('admin/produk/hapus_foto/'.$produk->id_produk.'/'.$val->id_foto_produk),'Hapus')?>
            </td>
		</tr>
        <?php $i++; endforeach; ?>
    </table>
<?php else: ?>
    <p class="msg info">Belum ada Foto untuk produk ini</p>
<?php endif; ?>

<div id="containerHolder">
	<div id="container">
   		<div style="padding-bottom:10px;">
			<?php if(isset($status)){echo $status;}?>
			<?php if(isset($error_notification)){echo $error_notification.'<br /><br />';}?>
			<?php if(isset($thepicture)){echo '<div class="imageborder">Crop area untuk dijadikan thumbnail <br /><br /><img src="'.$thepicture.'" id="cropbox" alt="cropbox"></div>';} ?>
			<?php if(isset($thepicture)){echo '<div style="clear:both; margin-bottom:20px;"></div>';} ?>
			<?php if(isset($form)){echo $form;} ?>
            <h3>Upload Foto Produk</h3>
        </div>
        <div class="clear"></div>
    </div>
</div>


<script type="text/javascript">
jQuery(function($) {
	$("#add").colorbox({
		width:"500", height:"500", iframe:true,
		onClosed:function(){ location.reload(); }
	});
});
<?php if(isset($ratio) && isset($orig_w) && isset($orig_h) && isset($target_w) && isset($target_h)): ?>
jQuery(document).ready(function($){
	$(function(){
		$('#cropbox').Jcrop({
			aspectRatio: <?php echo $ratio ?>,
			setSelect: [0,0,<?php echo $orig_w.','.$orig_h;?>],
			onSelect: updateCoords,
			onChange: updateCoords
		});
	});
	
	function updateCoords(c)
	{
		showPreview(c);
		$("#x").val(c.x);
		$("#y").val(c.y);
		$("#w").val(c.w);
		$("#h").val(c.h);
	};
			
	function showPreview(coords)
	{
		var rx = <?php echo $target_w;?> / coords.w;
		var ry = <?php echo $target_h;?> / coords.h;
		
		$("#preview img").css({
			width: Math.round(rx*<?php echo $orig_w;?>)+'px',
			height: Math.round(ry*<?php echo $orig_h;?>)+'px',
			marginLeft:'-'+  Math.round(rx*coords.x)+'px',
			marginTop: '-'+ Math.round(ry*coords.y)+'px'
		});
	};
});
<?php endif; ?>
</script>