<h1>Your Exercises</h1>
<h3><a href="<?php echo base_url('exercises/create'); ?>">Create New Exercise</a></h3>
<hr />
<?php if (isset($exercises)): ?>
    <?php foreach ($exercises as $ex): ?>
	<h3><a href="<?php echo base_url("exercises/view_one/{$ex['id']}"); ?>"><?php echo $ex['name']; ?></a></h3>
	<p><?php echo $ex['description']; ?></p>
	<?php $this->load->view('content/exerciselogs/logtable',$ex); ?>
	<hr />
    <?php endforeach; ?>
<?php else:?>
    <h3>You don't have any exercises!</h3>
<?php endif; ?>
