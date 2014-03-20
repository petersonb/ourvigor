<?php if (!$success): ?>
    <h1>Bug Submission</h1>
    <?php $this->load->view('forms/development/submit_bug'); ?>
<?php else: ?>
    <h1>Thank You!</h1>
    <p>Your bug report has been submitted and will be revied. Please keep tabs on your email, as we may contact you with questions. If you provided your phone number, we may also cantact you by phone.</p>
    <a href="<?php echo base_url('main'); ?>">Back to Main</a>
<?php endif; ?>
