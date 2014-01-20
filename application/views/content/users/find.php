<h1>Find Users</h1>

<?php $this->load->view('forms/users/find'); ?>

<?php if (isset($users)): ?>
    <?php foreach ($users as $user): ?>
	<?php echo '('.$user['firstname'].")<br />"; ?>
    <?php endforeach; ?>
<?php endif; ?>
