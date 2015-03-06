<?php 
if (@$sukses) {
    echo '<p class="msg done">'.@$sukses.'</p>';
    ?>
    <script type="text/javascript">
    (function($) {
    	$(function() {
    		parent.jQuery.colorbox.close();
    		return false;
    	});
    })(jQuery);
    </script>
    <?php 
}else{
    echo validation_errors();
    echo form_fieldset('Penambahan Kategori');
    echo form_open(site_url(uri_string()));
    echo form_label('Kode');
    echo form_input('kode',@$kode,'class="input-text"');
    echo form_label('Kategori');
    echo form_input('kategori',@$kategori,'class="input-text"');
    echo form_label('Parent');
    echo form_dropdown('parent',$list_kategori,@$parent);
    echo form_label('Deskripsi');
    echo form_textarea('deskripsi',@$deskripsi,'style="width:300px;height:100px;"');
    echo form_submit('submit','Submit','class="input-submit"');
    echo form_close();
    echo form_fieldset_close();   
}
?>