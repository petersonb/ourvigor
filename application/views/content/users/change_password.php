<h1>Change Password</h1>
<?php if ($success == FALSE): ?>
    <?php $this->load->view('forms/users/change_password'); ?>
<?php else: ?>
    <p>Your password was changed successfully.</p>
<?php endif; ?>
