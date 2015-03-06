<?php if($this->session->flashdata('pesan')): ?>
    <?php echo $this->session->flashdata('pesan'); ?>
<?php else:?>
    <h2>Login</h2>
    <br />
    <?php echo form_open(site_url(uri_string()),'class="order"'); ?>
    <?php echo form_label('Username'); ?>
    <?php echo form_input('username'); ?>
    <?php echo form_label('Password'); ?>
    <?php echo form_password('password'); ?>
    <?php if(@$error){echo @$error;} ?>
    <?php echo validation_errors(); ?>
    <?php echo form_submit('submit','Login'); ?>
    <?php echo form_close(); ?>
    <br />
<?php endif ?>