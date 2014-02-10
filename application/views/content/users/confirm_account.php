<h1>Account Confirmation</h1>
<?php if ($success): ?>
    <p>Thanks! Your account has been validated!</p>
<?php endif; ?>
<?php if (!$logged_in): ?>
    <p>Thank you for attempting to validate your email address.</p>
    <p>Please provide your password to complete the process.</p>
<?php $this->load->view('forms/users/confirm_account.php'); ?>
<?php endif; ?>
