<h1>Change Email</h1>
<?php if ($success): ?>
    <p>Thank you. An email has been sent to <?php echo $user['email']; ?>. Please follow the instructions provided in the email.</p>
<?php else: ?>
    <p>Note, you will have to validate this email before you can log continue to use OurVigor.</p>
    <?php $this->load->view('forms/users/change_email'); ?>
<?php endif; ?>
