<h1><?php echo $judul ?></h1>
<div id="menu" class="box">
	<ul class="box f-right">
	   <li><a href="<?php echo site_url('admin/kategori/tambah') ?>" id="add"><span><strong>Tambah Kategori</strong></span></a></li>
    </ul>
</div>
<h3 class="tit">Kategori Produk</h3>
	<table>
		<tr>
		    <th>Nama Kategori</th>
            <th>Kode</th>
		    <th>Deskripsi</th>
		    <th>Status</th>
            <th>Action</th>
		</tr>
        <?php $i=0; foreach ($kategori as $key => $val): ?>
		<tr <?php echo $i%2 == 0 ? 'class="bg"' : '';  ?>>
            
		    <td><?php echo $val['nama_kategori']; ?></td>
		    <td><?php echo $val['kode_kategori']; ?></td>
		    <td><?php echo $val['deskripsi']; ?></td>
		    <td><?php echo $val['status'] == 1 ? anchor(uri_string().'/aktifasi/'.$val['id_kategori'].'/0','Aktif', 'class="active"') : anchor(uri_string().'/aktifasi/'.$val['id_kategori'].'/1','Tidak Aktif', 'class="no-active"'); ?></td>
            <td>
                <?php echo anchor(uri_string().'/hapus/'.$val['id_kategori'],'Hapus')?>
                 | 
                <?php echo anchor(uri_string().'/ubah/'.$val['id_kategori'],'Ubah','class="ubah"')?>
            </td>
		</tr>
        <?php $i++; endforeach; ?>
    </table>

<script type="text/javascript">
jQuery(function($) {
	$("#add, .ubah").colorbox({
		width:"400", height:"500", iframe:true,
		onClosed:function(){ location.reload(); }
	});
});
</script>