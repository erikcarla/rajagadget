<h1><?php echo $judul ?></h1>
<div id="menu" class="box">
	<ul class="box f-right">
	   <li><a href="<?php echo site_url('admin/user/tambah') ?>" id="add"><span><strong>Tambah User Baru</strong></span></a></li>
    </ul>
</div>
<h3 class="tit">Riwayat Belanja</h3>
<b>Profile :</b>
<div><?php echo $profile->nama_depan.' '.$profile->nama_belakang; ?></div>
<div><?php echo $profile->alamat; ?></div>
<div><?php echo $profile->kode_pos; ?></div>
<div>Telp. <?php echo $profile->phone; ?></div>
<br />
<?php if ($order == array()): ?>
<div class="note-cart">Belum ada record belanja untuk user ini</div>
<?php else: ?>
<table class="user-record" cellspacing="0" cellpadding="3px">
    <tr>
        <th>Order ID</th>
        <th>Tanggal Belanja</th>
        <th>Jumlah Item</th>
        <th>Total Belanja</th>
        <th>Status</th>
    </tr>
<?php foreach ($order as $item): ?>
    <tr>
        <td><?php echo anchor(site_url('admin/user/detail/'.$item['id_order']), $item['id_order'].' Detail', 'class="active" id="detail"') ?></td>
        <td><?php echo $item['tanggal_masuk']; ?></td>
        <td><?php echo $item['total_item']; ?></td>
        <td> Rp. <?php echo $this->cart->format_number($item['total_biaya']); ?></td>
        <td><?php echo $item['status_order_text']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4">Detail</td>
    </tr>
    <?php foreach($item['detail'] as $detail): ?>
    <tr>
        <td></td>
        <td><?php echo $detail['nama_produk']; ?></td>
        <td><?php echo $detail['kuantitas']; ?></td>
        <td>Rp. <?php echo $this->cart->format_number($detail['subtotal']); ?></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="5"></td>
    </tr>
    <?php endforeach; ?>
<?php endforeach; ?>
</table>
<?php endif; ?>
<script type="text/javascript">
jQuery(function($) {
	$(".active").colorbox({
		width:"500", height:"500", iframe:true,
		onClosed:function(){ location.reload(); }
	});
});
</script>