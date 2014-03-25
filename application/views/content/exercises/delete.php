<?php if (!$success): ?>
    <h1>Delete <?php echo $exercise['name'] ?>?</h1>
    <?php if ($exercise['description']): ?>
	<p><?php echo $exercise['description']; ?></p>
    <?php endif; ?>
    <?php $this->load->view('forms/exercises/delete'); ?>
<?php else: ?>
    <h1>Success</h1>
    <p>Your exercise and all of its logs have successfully been deleted.</p>
    <a href="<?php echo base_url('exercises/view'); ?>">Return to Exercises</a>
<?php endif; ?>
