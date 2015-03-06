<div class="form-login">

<div class="login-right">
    <div class="form-login-wrapper">
    <h3>Login</h3>
    <?php 
    echo form_open('login');
    echo form_label('Username','username');
    echo form_input('username');
    echo form_label('Password','password');
    echo form_password('password');
    echo form_submit('submit','login');
    echo form_close();
    ?>
    </div>
</div>
<div class="clear"></div>
</div>