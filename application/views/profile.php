<h2>Profil</h2>
<?php if(@$sukses){echo @$sukses;} ?>
<br />
<?php echo form_open(site_url(uri_string()),'class="order"'); ?>
<?php echo form_label('Nama'); ?>
<?php echo form_input('nama',$nama); ?>
<?php echo form_label('Alamat'); ?>
<?php echo form_textarea('alamat',$alamat,'style="width:400px;height:150px;"'); ?>
<?php echo form_label('Kode Pos'); ?>
<?php echo form_input('kode_pos',$kode_pos); ?>
<?php echo form_label('Telephone'); ?>
<?php echo form_input('phone',$phone); ?>
<?php echo validation_errors(); ?>
<?php echo form_submit('submit','Simpan'); ?>
<?php echo form_close(); ?>