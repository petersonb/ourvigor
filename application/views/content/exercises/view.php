<h1>Your Exercises</h1>
<a href="<?php echo base_url('exercises/create'); ?>">Create New Exercise</a>
<?php if (isset($exercises)): ?>
    <?php foreach ($exercises as $ex): ?>
	<table>
	    <tr>
		<td><a href="<?php echo base_url("exercises/view_one/{$ex['id']}"); ?>"><?php echo $ex['name']; ?></a></td>
		<td><?php echo $ex['description']; ?></td>
	    </tr>
	</table>
	<?php $this->load->view('content/exerciselogs/logtable',$ex); ?>
    <?php endforeach; ?>
<?php else:?>
    <h3>You don't have any exercises!</h3>
<?php endif; ?>
