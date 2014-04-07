<?php echo validation_errors(); ?>
<?php echo form_open("exerciselogs/log/{$exercise['id']}"); ?>
<table>
    <tr>
	<td>Exercise: </td>
	<td><?php echo $exercise['name']; ?></td>
    </tr>
    <tr>
	<td>Date</td>
	<td><input type="text" id="datepicker" value="<?php echo $date; ?>" name="date" /></td>
    </tr>
    <?php if($exercise['fields']['dist']): ?>
	<tr>
	    <td>Distance</td>
	    <td>
		<input style="width:5em" type="text" name="distance" /> Miles
	    </td>
	</tr>
    <?php endif; ?>
    <?php if($exercise['fields']['time']): ?>
	<tr>
	    <td>Time:</td>
	    <td>
		<input style="width:2em" type="text" name="time_hours" />
		:
		<input style="width:2em" type="text" name="time_minutes" />
		:
		<input style="width:2em" type="text" name="time_seconds" />
	    </td>
	</tr>
    <?php endif; ?>
    <?php if($exercise['fields']['laps']): ?>
	<tr>
	    <td>Laps</td>
	    <td><input type="text" name="laps" /></td>
	</tr>
    <?php endif; ?>
    <?php if($exercise['fields']['wght']): ?>
	<tr>
	    <td>Weight</td>
	    <td><input style="width:5em" type="text" name="wght" /> lbs</td>
	</tr>
    <?php endif; ?>
    <?php if($exercise['fields']['reps']): ?>
	<tr>
	    <td>Reps</td>
	    <td><input style="width:5em" type="text" name="reps" /></td>
	</tr>
    <?php endif; ?>
    <?php if($exercise['fields']['sets']): ?>
	<tr>
	    <td>Sets</td>
	    <td><input style="width:5em" type="text" name="sets" /></td>
	</tr>
    <?php endif; ?>
</table>
<input type="submit" value="Save Exercise" />
<?php echo form_close(); ?>
