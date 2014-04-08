<?php if (count($logs) >  0): ?>
    <table class="datatable">
	<thead>
	<tr>
	    <th>Date</th>
	    
	    <?php if($fields['dist']): ?>
		<th>Distance</th>
	    <?php endif; ?>
	    
	    <?php if($fields['time']): ?>
		<th>Time</th>
	    <?php endif; ?>
	    
	    <?php if($fields['laps']): ?>
		<th>Laps</th>
	    <?php endif; ?>

	    <?php if($fields['wght']): ?>
		<th>Weight</th>
	    <?php endif; ?>

	    <?php if($fields['reps']): ?>
		<th>Reps</th>
	    <?php endif; ?>

	    <?php if($fields['sets']): ?>
		<th>Sets</th>
	    <?php endif; ?>
	    <th></th>
	</tr>
	</thead>
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
    <br />
<?php endif; ?>
