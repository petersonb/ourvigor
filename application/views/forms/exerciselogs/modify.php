<?php echo validation_errors(); ?>
<?php echo form_open('exerciselogs/modify/'.$log['id']); ?>
    <table>
	<tr>
	    <td>Exercise: </td>
	    <td><?php echo $exercise['name']; ?></td>
	</tr>
	<tr>
	    <td>Date :</td>
	    <td><input type="text" id="datepicker" value="<?php echo $log['date']; ?>" name="date" /></td>
	</tr>
	<?php if ($exercise['fields']['dist']): ?>
	    <tr>
		<td>Distance:</td>
		<td>
		    <input style="width:2em" type="text" name="distance" value="<?php echo $log['distance']; ?>" /> Miles
		</td>
	    </tr>
	<?php endif; ?>
	<?php if($exercise['fields']['time']): ?>
	    <tr>
		<td>Time:</td>
		<td>
		    <input style="width:2em" type="text" name="time_hours" value="<?php echo $log['time']['hours']; ?>" />
		    :
		    <input style="width:2em" type="text" name="time_minutes" value="<?php echo $log['time']['minutes']; ?>" />
		    :
		    <input style="width:2em" type="text" name="time_seconds" value="<?php echo $log['time']['seconds']; ?>" />
		</td>
	    </tr>
	<?php endif; ?>
	<?php if($exercise['fields']['laps']): ?>
	    <tr>
		<td>Laps</td>
		<td><input type="text" name="laps" value="<?php echo $log['laps']; ?>"/></td>
	    </tr>
	<?php endif; ?>
	<?php if($exercise['fields']['wght']): ?>
	    <tr>
		<td>Weight</td>
		<td><input style="width:5em" type="text" name="wght" value="<?php echo $log['wght']; ?>"/> lbs</td>
	    </tr>
	<?php endif; ?>
	<?php if($exercise['fields']['reps']): ?>
	    <tr>
		<td>Reps</td>
		<td><input style="width:5em" type="text" name="reps" value="<?php echo $log['reps']; ?>"/></td>
	    </tr>
	<?php endif; ?>
	<?php if($exercise['fields']['sets']): ?>
	    <tr>
		<td>Sets</td>
		<td><input style="width:5em" type="text" name="sets" value="<?php echo $log['sets']; ?>"/></td>
	    </tr>
	<?php endif; ?>
    </table>
    <input type="submit" value="Save Exercise" />
    <?php echo form_close(); ?>
