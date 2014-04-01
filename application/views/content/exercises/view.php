<h1>Your Exercises</h1>

<?php if (isset($exercises)): ?>

    <?php foreach ($exercises as $ex): ?>
	<table>
	    <tr>
		<td><a href="<?php echo base_url("exercises/view_one/{$ex['id']}"); ?>"><?php echo $ex['name']; ?></a></td>
		<td><?php echo $ex['description']; ?></td>
	    </tr>
	</table>
	<?php if (sizeof($ex['logs']) > 0): ?>
	    <table style="margin-left: 5em;">
		<tr>
		    <td></td>
		    <td>Date</td>
		    <td>Distance</td>
		    <td>Time</td>
		    <?php foreach ($ex['logs'] as $log): ?>
			<tr>
			    <td></td>
			    <td><?php echo $log['date']; ?>
				<td><?php echo $log['distance']; ?></td>
				<td><?php echo $log['time']; ?></td>
				<td><a href="<?php echo base_url('exercises/modify_log/'.$log['id']); ?>">Edit</a></td>
			</tr>
		    <?php endforeach; ?>
	    </table>
	<?php endif; ?>
    <?php endforeach; ?>
<?php else:?>
    <h3>You don't have any exercises!</h3>
<?php endif; ?>
