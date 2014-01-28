<table id="exercise_<?php echo $index ?>">
    <tr>
	<td>Name <?php echo $index; ?></td>
	<td><input type="text" name="exercise_name_<?php echo $index; ?>" /></td>
    </tr>
    <tr>
	<td>Description</td>
	<td><input type="text" name="description_<?php echo $index; ?>" /></td>
    </tr>
    <tr>
	<td colspan="2">Measure</td>
    </tr>
    <tr>
	<td>
	    <input type="text" name="measure_value_<?php echo $index; ?>[]" />
	</td>
	<td>
	    <select name="measure_unit_<?php echo $index; ?>[]">
		<option>---</option>
		<option>Count</option>
		<option>Miles</option>
		<option>KM</option>
	    </select>
	</td>
    </tr>
    <tr>
	<td colspan="2">
	    <input type="button" onclick="removeExercise(<?php echo $index; ?>)" value="Remove" />
	</td>
</table>
