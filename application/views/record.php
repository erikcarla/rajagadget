<h2>Record</h2>
<?php if ($order == array()): ?>
<div class="note-cart">Anda Belum pernah berbelanja di sini</div>
<?php else: ?>
<table class="user-record" cellspacing="0" cellpadding="3px">
    <tr>
        <th>Tanggal Belanja</th>
        <th>Jumlah Item</th>
        <th>Total Belanja</th>
        <th>Status</th>
    </tr>
<?php foreach ($order as $item): ?>
    <tr>
        <td><?php echo $item['tanggal_masuk']; ?></td>
        <td><?php echo $item['total_item']; ?></td>
        <td> Rp. <?php echo $this->cart->format_number($item['total_biaya']); ?></td>
        <td><?php echo $item['status_order_text']; ?></td>
    </tr>
    <tr>
        <td colspan="4" align="center">Detail</td>
    </tr>
    <?php foreach($item['detail'] as $detail): ?>
    <tr>
        <td><?php echo $detail['nama_produk']; ?></td>
        <td><?php echo $detail['kuantitas']; ?></td>
        <td>Rp. <?php echo $this->cart->format_number($detail['subtotal']); ?></td>
    </tr>
     <td colspan="5" style="background-color: #8FBBEF;"></td>
    <?php endforeach; ?>
<?php endforeach; ?>
</table>
<?php endif; ?>