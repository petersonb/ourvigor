<h1>Forgot Password</h1>
<?php if (!$success): ?>
    <?php $this->load->view('forms/users/forgot_password'); ?>
<?php else: ?>
    <p>Thank you. Please check your email for a message concerning resetting your password.</p>
<?php endif; ?>
