<?php echo validation_errors(); ?>
<?php echo form_open('exercises/modify_log/'.$log['id']); ?>
    <table>
	<tr>
	    <td>Exercise: </td>
	    <td><?php echo $exercise['name']; ?></td>
	</tr>
	<tr>
	    <td>Date :</td>
	    <td><input type="text" id="datepicker" value="<?php echo $log['date']; ?>" name="date" /></td>
	</tr>
	<tr>
	    <td>Distance:</td>
	    <td>
		<input style="width:2em" type="text" name="distance" value="<?php echo $log['distance']; ?>" /> Miles
	    </td>
	</tr>
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
    </table>
    <input type="submit" value="Save Exercise" />
<?php echo form_close(); ?>
