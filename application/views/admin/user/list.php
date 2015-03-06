<h1><?php echo $judul ?></h1>
<div id="menu" class="box">
	<ul class="box f-right">
	   <li><a href="<?php echo site_url('admin/user/tambah') ?>" id="add"><span><strong>Tambah User Baru</strong></span></a></li>
    </ul>
</div>
<h3 class="tit">Daftar User</h3>
<?php echo $this->session->flashdata('user_note'); ?>
<?php if($user!= array()): ?>
	<table>
		<tr>
            <th>No</th>
		    <th>Username</th>
            <th>Email</th>
            <th>Level</th>
		    <th>Status</th>
            <th>Action</th>
		</tr>
        <?php $i=1; foreach ($user as $val): ?>
		<tr <?php echo $i%2 == 0 ? 'class="bg"' : '';  ?>>
		    <td><?php echo $i ?></td>
		    <td><?php echo $val->username; ?></td>
            <td><?php echo $val->email; ?></td>
		    <td><?php echo $val->level; ?></td>
		    <td><?php echo $val->status == 1 ? anchor(uri_string().'/aktifasi/'.$val->id_user.'/0','Aktif', 'class="active"') : anchor(uri_string().'/aktifasi/'.$val->id_user.'/1','Tidak Aktif', 'class="no-active"'); ?></td>
            <td>
                <?php echo anchor(uri_string().'/record/'.$val->id_user,'Record')?> 
                 |
                <?php echo anchor(uri_string().'/profile/'.$val->id_user,'Profile','id="profile"')?> 
                 |
                <?php echo anchor(uri_string().'/hapus/'.$val->id_user,'Hapus')?>
                 | 
                <?php echo anchor(uri_string().'/ubah/'.$val->id_user,'Ubah','id="ubah"')?>
            </td>
		</tr>
        <?php $i++; endforeach; ?>
    </table>
<?php else: ?>
    <p class="msg info">Belum ada Produk yang tersedia</p>
<?php endif; ?>
<script type="text/javascript">
jQuery(function($) {
	$("#add,#ubah,#profile").colorbox({
		width:"500", height:"500", iframe:true,
		onClosed:function(){ location.reload(); }
	});
});
</script>