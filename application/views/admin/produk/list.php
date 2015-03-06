<h1><?php echo $judul ?></h1>
<div id="menu" class="box">
	<ul class="box f-right">
	   <li><a href="<?php echo site_url('admin/produk/tambah') ?>" id="add"><span><strong>Tambah Produk Baru</strong></span></a></li>
    </ul>
</div>
<h3 class="tit">Daftar Produk</h3>
<?php if($produk!= array()): ?>
	<table>
		<tr>
            <th>Kode</th>
		    <th>Nama Produk</th>
            <th>Kategori</th>
		    <th>Harga</th>
            <th>Stok</th>
		    <th>Status</th>
            <th>Action</th>
		</tr>
        <?php $i=0; foreach ($produk as $val): ?>
		<tr <?php echo $i%2 == 0 ? 'class="bg"' : '';  ?>>
		    <td><?php echo $val->kode_produk; ?></td>
		    <td><?php echo $val->nama_produk; ?></td>
            <td><?php echo $val->nama_kategori; ?></td>
		    <td><?php echo $val->harga_baru == 0 ? $val->harga_jual : '<div style="color:red">'.$val->harga_baru.'</div>'; ?></td>
            <td><?php echo $val->stok != 0 ? $val->stok : '<div class="no-stock">stok habis</div>'; ?></td>
		    <td><?php echo $val->status_produk == 1 ? anchor(uri_string().'/aktifasi/'.$val->id_produk.'/0','Aktif', 'class="active"') : anchor(uri_string().'/aktifasi/'.$val->id_produk.'/1','Tidak Aktif', 'class="no-active"'); ?></td>
            <td>
                <?php echo anchor(uri_string().'/hapus/'.$val->id_produk,'Hapus')?>
                 | 
                <?php echo anchor(uri_string().'/ubah/'.$val->id_produk,'Ubah','class="ubah"')?>
            </td>
		</tr>
        <?php $i++; endforeach; ?>
    </table>
<?php else: ?>
    <p class="msg info">Belum ada Produk yang tersedia</p>
<?php endif; ?>
<script type="text/javascript">
jQuery(function($) {
	$("#add").colorbox({
		width:"500", height:"500", iframe:true,
		onClosed:function(){ location.reload(); }
	});
});
</script>