<?php echo validation_errors(); ?>
<?php echo form_open('exercises/log'); ?>
<?php if (count($user_exercises) > 0): ?>
    <table>
	<tr>
	    <td>Exercise: </td>
	    <td>
		<select name="exercise_id">
		    <?php foreach ($user_exercises as $exercise): ?>
			<option value="<?php echo $exercise['id']; ?>"><?php echo $exercise['name']; ?></option>
		    <?php endforeach; ?>
		</select>
	    </td>
	</tr>
	<tr>
	    <td>Distance:</td>
	    <td>
		<input type="text" name="distance" />
	    </td>
	</tr>
	<tr>
	    <td>Time:</td>
	    <td><input type="text" name="time_hour" />:
		<input type="text" name="time_minute" />:
		<input type="text" name="time_second" />
	</tr>
    </table>
    <input type="submit" value="Save Exercise" />
<?php else: ?>
    <h3>You have no exercises!</h3>
<?php endif; ?>
</form>
