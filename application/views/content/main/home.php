<h1>Fitness Website</h1>
<?php if (!$this->user_id): ?>
    <h3>Login</h3>
    <?php $this->load->view('forms/users/login'); ?>
<?php endif; ?>
