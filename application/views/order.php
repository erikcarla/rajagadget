<?php if (!$logged_in): ?>
    Anda Harus Login terlebih dahulu.
<?php else: ?>
    <?php if($this->session->flashdata('pesan')): ?>
        <?php echo $this->session->flashdata('pesan'); ?>
        <p>Pembayaran mohon ditransfer ke rekening berikut:</p>
        	<img src="<?php echo base_url().'template/template/images/logo_bca.jpg' ?>"/>
            <div id="rek">BCA : 7532 65 3434<br />
			Atas nama : Joe Erik Carla Wijaya</div><br />
<br />
Menerima Pembayaran dari :<br />
            <img src="<?php echo base_url().'template/template/images/icon_bca.gif' ?>"/>
            <img src="<?php echo base_url().'template/template/images/icon_bni-b.gif' ?>"/>
            <img src="<?php echo base_url().'template/template/images/icon_mandiri-b.gif' ?>"/>
            <img src="<?php echo base_url().'template/template/images/icon_mandiriclickpay.gif' ?>"/>
    <?php else:?>
        <h2>Record</h2>
        <?php echo form_open(site_url(uri_string()),'class="order"'); ?>
        <table cellpadding="6" cellspacing="1" style="width:100%" border="0">
    
        <tr>
          <th>Nama Barang</th>
          <th align="center">QTY</th>
          <th style="text-align:right">Harga Satuan</th>
          <th style="text-align:right">Sub-Total</th>
        </tr>
        
        <?php $i = 1;$total_item = 0; ?>
        
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
              <td align="center"><?php echo $items['qty']; ?></td>
        	  <td style="text-align:right"><?php echo $this->cart->format_number($items['price']); ?></td>
        	  <td style="text-align:right">Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
        	</tr>
        
        <?php $i++;$total_item = $total_item + $items['qty']; ?>
        
        <?php endforeach; ?>
        
        <tr>
          <td></td>
          <td></td>
          <td style="text-align:right; background-color: #FFF0F0;"><strong>Total</strong></td>
          <td style="text-align:right; background-color: #FFF0F0;"><strong>Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></strong></td>
        </tr>
        
        </table>
        
        <h2>Alamat Pengiriman</h2>
        <?php 
        echo form_hidden('total_item',$total_item);
        echo form_label('Nama');
        echo form_input('nama',$nama);
        echo form_label('Alamat');
        echo form_textarea('alamat',$alamat,'style="width:400px;height:150px;"');
        echo form_label('Kode Pos');
        echo form_input('kode_pos',$kode_pos);
        echo form_label('Telephone');
        echo form_input('phone',$phone);
        echo form_submit('submit','Pesan Sekarang');
        ?>
    <?php endif; ?>
<?php endif; ?>