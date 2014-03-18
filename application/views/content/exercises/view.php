<h1>Your Exercises</h1>

<?php if (isset($exercises)): ?>
    <table>
	<?php foreach ($exercises as $ex): ?>
	    <tr>
		<td><?php echo $ex['name']; ?></td>
		<td><?php echo $ex['description']; ?></td>
	    </tr>
	    <?php if (sizeof($ex['logs']) > 0): ?>
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
			</tr>
		    <?php endforeach; ?>
	    <?php endif; ?>
	<?php endforeach; ?>
    </table>
<?php else:?>
    <h3>You don't have any exercises!</h3>
<?php endif; ?>
