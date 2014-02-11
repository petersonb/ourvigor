<table id="exercise_<?php echo $index; ?>">
    <input type="hidden" name="exercises[<?php echo $index; ?>]" value="<?php echo $index; ?>" />
    <tr>
	<td>Name</td>
	<td><input type="text" name="exercise_names[<?php echo $index; ?>]" value="<?php if (isset($name)) echo $name;?>" /></td>
    </tr>
    <tr>
	<td>Description</td>
	<td><input type="text" name="exercise_descriptions[<?php echo $index; ?>]" value="<?php if (isset($description)) echo $description; ?>" /></td>
    </tr>
    <!--
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
    -->
    <tr>
	<td colspan="2">
	    <input type="button" onclick="removeExercise(<?php echo $index; ?>)" value="Remove" />
	</td>
</table>
