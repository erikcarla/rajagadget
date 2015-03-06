<?php if(@$sukses):?>
    <?php echo '<p class="msg done">'.@$sukses.'</p>';?>
    <script type="text/javascript">
    (function($) {
    	$(function() {
    		parent.jQuery.colorbox.close();
    		return false;
    	});
    })(jQuery);
    </script>
<?php else: ?>

<div class="col">
<b>Data Pemesan :</b>
<?php foreach($detail as $data): ?>
<div><?php echo $data['nama']; ?></div>
<div><?php echo $data['alamat']; ?></div>
<div><?php echo $data['kode_pos']; ?></div>
<div>Telp. <?php echo $data['phone']; ?></div>
</div>
<div class="col">
<b>Status Pesanan</b>
<form action="<?php echo site_url(uri_string()); ?>" method="POST">
<?php 
$select = array('Data belum diproses','Data sedang di proses','Barang sedang di kirim','Selesai');
echo form_dropdown('status',$select,$data['status_order']);
echo form_submit('submit','Simpan Perubahan');
?>
</form>
</div>
<div class="clear"></div>
<br />
<b>Detail Pesanan :</b>
<table cellspacing="0" cellpadding="3px">
    <tr>
        <th>Order ID</th>
        <th>Tanggal Belanja</th>
        <th>Jumlah Item</th>
        <th>Total Belanja</th>
    </tr>

    <tr>
        <td><?php echo $data['id_order']; ?></td>
        <td><?php echo $data['tanggal_masuk']; ?></td>
        <td><?php echo $data['total_item']; ?></td>
        <td> Rp. <?php echo $this->cart->format_number($data['total_biaya']); ?></td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3"><b>Rincian :: </b></td>
    </tr>
    <?php foreach($data['detail'] as $detail): ?>
    <tr>
        <td></td>
        <td><?php echo $detail['nama_produk']; ?></td>
        <td><?php echo $detail['kuantitas']; ?></td>
        <td>Rp. <?php echo $this->cart->format_number($detail['subtotal']); ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endforeach; ?>

<style>
table { border: solid 1px gray; width: 100%; margin: 0 auto;}
th { text-align: center; background-color: black; color: white;}
td { border: solid 1px silver; padding: 5px;}
.col {width: 50%; float: left;}
.clear {clear: both;}
</style>

<?php endif; ?>