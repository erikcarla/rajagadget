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
    <?php echo validation_errors(); ?>
    <br />
    <?php echo form_fieldset('Profil User');?>
    <?php echo form_open(site_url(uri_string()),'class="order"'); ?>
    <?php echo form_label('Nama'); ?>
    <?php echo form_input('nama',$nama); ?>
    <?php echo form_label('Alamat'); ?>
    <?php echo form_textarea('alamat',$alamat,'style="width:400px;height:60px;"'); ?>
    <?php echo form_label('Kode Pos'); ?>
    <?php echo form_input('kode_pos',$kode_pos); ?>
    <?php echo form_label('Telephone'); ?>
    <?php echo form_input('phone',$phone); ?>
    <?php echo form_submit('submit','Simpan'); ?>
    <?php echo form_close(); ?>
    <?php echo form_fieldset_close(); ?>
<?php endif ?>