<h1><?php echo $exercise['name']; ?></h1>
<?php if ($exercise['description']): ?>
    <p><?php echo $exercise['description']; ?></p>
<?php endif; ?>

<a href="<?php echo base_url("exercises/modify/{$exercise['id']}"); ?>">Modify This Exercise</a>

<?php if (sizeof($exercise['logs']) > 0): ?>
    <table>
	<tr>
	    <td></td>
	    <td>Date</td>
	    <td>Distance</td>
	    <td>Time</td>
	    <?php foreach ($exercise['logs'] as $log): ?>
		<tr>
		    <td></td>
		    <td><?php echo $log['date']; ?>
			<td><?php echo $log['distance']; ?></td>
			<td><?php echo $log['time']; ?></td>
		</tr>
	    <?php endforeach; ?>
    </table>
<?php endif; ?>
