<p>Dear <?php echo $user['firstname']; ?>,</p>

<p>We have received a request to reset your password. Please click <a href="<?php echo base_url("users/confirm_password_reset?code={$code}&email={$user['email']}"); ?>">here</a> to reset your password, or follow the link below.</p>

<p><a href="<?php echo base_url("users/confirm_password_reset?code={$code}&email={$user['email']}"); ?>">Reset My Password</a></p>

OurVigor
