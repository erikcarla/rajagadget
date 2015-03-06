 <?php echo form_open(site_url(uri_string())); ?>

<table cellpadding="6" cellspacing="1" style="width:100%" border="0">

<tr>
  <th>Nama Barang</th>
  <th align="center">QTY</th>
  <th style="text-align:right">Harga Satuan</th>
  <th style="text-align:right">Sub-Total</th>
</tr>

<?php $i = 1; ?>

<?php foreach($this->cart->contents() as $items): ?>

	<?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

	<tr>
	  <td>
		<?php echo $items['name']; ?>

			<?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

				<p>
					<?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

						<strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

					<?php endforeach; ?>
				</p>

			<?php endif; ?>

	  </td>
      <td align="center"><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
	  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
	  <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
	</tr>
    

<?php $i++; ?>

<?php endforeach; ?>

<tr>
  <td></td>
  <td></td>
  <td style="text-align:right; background-color: #FFF0F0;"><strong>Total</strong></td>
  <td style="text-align:right; background-color: #FFF0F0;"><strong>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
</tr>

</table>

<div class="left"><?php echo form_submit('store/checkout', 'Update Shopping Cart'); ?></div>
<div class="right"><a href="<?php echo site_url('store/order') ?>" class="clear">Lanjut</a></div>
<div class="clear"></div>

