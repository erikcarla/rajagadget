<h1><?php echo $judul ?></h1>
<div id="menu" class="box">
	<ul class="box f-right">
	   </ul>
</div>
<h3 class="tit">Riwayat Belanja</h3>
<?php if ($laporan == array()): ?>
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
<?php foreach ($laporan as $item): ?>
    <tr>
        <td><?php echo anchor(uri_string().'/detail/'.$item['id_order'], $item['id_order'], 'class="active" id="detail"') ?></td>
        <td><?php echo $item['tanggal_masuk']; ?></td>
        <td><?php echo $item['total_item']; ?></td>
        <td> Rp. <?php echo $this->cart->format_number($item['total_biaya']); ?></td>
        <td><?php echo $item['status_order_text']; ?></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="4"><b>Nama Client :: </b><?php echo $item['nama']; ?></td>
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
        <td colspan="5" style="background-color: #8FBBEF;"></td>
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