<?php if (!$logged_in): ?>
    <li class="current_page_item"><?php echo anchor(site_url('user/login'),'Login') ?></li>
    <li class="current_page_item"><?php echo anchor(site_url('user/register'),'Register') ?></li>
<?php else: ?>
    <li class="current_page_item"><?php echo anchor(site_url('user/profile'),'Profil') ?></li>
    <li class="current_page_item"><?php echo anchor(site_url('user/record'),'Record') ?></li>
    <li class="current_page_item"><?php echo anchor(site_url('user/edit'),'Edit Akun') ?></li>
    <li class="current_page_item"><?php echo anchor(site_url('user/logout'),'Logout') ?></li>
<?php endif; ?>