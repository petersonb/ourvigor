<?php if (count($logs) >  0): ?>
    <table style="margin-left: 5em;">
	<tr>
	    <td>Date</td>
	    
	    <?php if($fields['dist']): ?>
		<td>Distance</td>
	    <?php endif; ?>
	    
	    <?php if($fields['time']): ?>
		<td>Time</td>
	    <?php endif; ?>
	    
	    <?php if($fields['laps']): ?>
		<td>Laps</td>
	    <?php endif; ?>

	    <?php if($fields['wght']): ?>
		<td>Weight</td>
	    <?php endif; ?>

	    <?php if($fields['reps']): ?>
		<td>Reps</td>
	    <?php endif; ?>

	    <?php if($fields['sets']): ?>
		<td>Sets</td>
	    <?php endif; ?>
	    
	    <?php foreach ($logs as $log): ?>
		<tr>
		    <td><?php echo $log['date']; ?></td>

		    <?php if ($fields['dist']): ?>
			<td><?php echo $log['distance']; ?></td>
		    <?php endif; ?>

		    <?php if ($fields['time']): ?>
			<td><?php echo $log['time']; ?></td>
		    <?php endif; ?>
		    
		    <?php if ($fields['laps']): ?>
			<td><?php echo $log['laps']; ?></td>
		    <?php endif; ?>

		    <?php if ($fields['wght']): ?>
			<td><?php echo $log['wght']; ?></td>
		    <?php endif; ?>

		    <?php if ($fields['reps']): ?>
			<td><?php echo $log['reps']; ?></td>
		    <?php endif; ?>

		    <?php if ($fields['sets']): ?>
			<td><?php echo $log['sets']; ?></td>
		    <?php endif; ?>
		    
		    <td><a href="<?php echo base_url('exerciselogs/modify/'.$log['id']); ?>">Edit</a></td>
		</tr>
	    <?php endforeach; ?>
    </table>
<?php endif; ?>	
