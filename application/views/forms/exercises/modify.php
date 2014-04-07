<?php echo validation_errors(); ?>
<?php echo form_open("exercises/modify/{$exercise['id']}"); ?>
<table>
    <tr>
	<td>Name*</td>
	<td>
	    <input type="text" name="name" value="<?php if (set_value('name')) echo set_value('name'); else echo $exercise['name']; ?>" />
	</td>
    </tr>
    <tr id="description_row">
	<td>Description<br />(500 chars)</td>
	<td>
	    <textarea id="description_textarea" name="description" style="resize:none"><?php if (set_value('description')) echo set_value('description'); else echo $exercise['description']; ?></textarea>
	</td>
    </tr>
</table>
<p id="toggle_description" style="cursor:pointer; color : #00F; text-decoration : underline;">Include Description</p>
<h3>How would you like to log this exercise?</h3>
<table>
    <tr>
	<td><input type="checkbox" name="type[]" value="time" <?php if ($exercise['fields']['time']): ?>checked="checked"<?php endif; ?>/></td>
	<td>Time</td>
    </tr>
    <tr>
	<td><input type="checkbox" name="type[]" value="dist" <?php if ($exercise['fields']['dist']): ?>checked="checked"<?php endif; ?>/></td>
	<td>Distance</td>
    </tr>
    <tr>
	<td><input type="checkbox" name="type[]" value="laps" <?php if ($exercise['fields']['laps']): ?>checked="checked"<?php endif; ?>/></td>
	<td>Laps</td>
    </tr>
    <tr>
	<td><input type="checkbox" name="type[]" value="wght" <?php if ($exercise['fields']['wght']): ?>checked="checked"<?php endif; ?>/></td>
	<td>Weight</td>
    </tr>
    <tr>
	<td><input type="checkbox" name="type[]" value="reps" <?php if ($exercise['fields']['reps']): ?>checked="checked"<?php endif; ?>/></td>
	<td>Repetitions</td>
    </tr>
    <tr>
	<td><input type="checkbox" name="type[]" value="sets" <?php if ($exercise['fields']['sets']): ?>checked="checked"<?php endif; ?>/></td>
	<td>Sets</td>
    </tr>
</table>
<input type="submit" value="Save Exercise" />
<input type="hidden" id="include_description" name="include_description" value="1" />
<?php echo form_close(); ?>
