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
    <?php if(@$error){echo @$error;} ?>
    <?php echo validation_errors(); ?>
    <br />
    <?php echo form_fieldset('Penambahan User Baru'); ?>
    <?php echo form_open(site_url(uri_string()),'class="order"'); ?>
    <?php echo form_label('Username'); ?>
    <?php echo form_input('username',$username); ?>
    <?php echo form_label('E-mail'); ?>
    <?php echo form_input('email',$email); ?>
    <?php echo form_label('Level'); ?>
    <?php echo form_dropdown('level',array('user'=>'User','admin'=>'Admin')); ?>
    <?php echo form_label('Password'); ?>
    <?php echo form_password('password'); ?>
    <?php echo form_label('Confirm Password'); ?>
    <?php echo form_password('conf_password'); ?>
    <?php echo form_submit('submit','Register'); ?>
    <?php echo form_close(); ?>
    <?php echo form_fieldset_close(); ?>
    <br />
<?php endif ?>