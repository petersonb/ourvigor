<h1>Please Validate Your Email</h1>
<h3><?php echo $user['email']; ?></h3>

<p>You have been directed to this page because you have not validated your email address. Please check your email for a validation email.</p>

<?php if(!$sent): ?>
<p>If you have not received an email, click <a href="<?php echo base_url('users/resend_confirmation_email'); ?>">Here</a> to send another.</p>
<?php else: ?>
<p>Another email has been sent. Please be patient.</p>
<?php endif; ?>
