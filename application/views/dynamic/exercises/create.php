<div id="exercise_<?php echo $index; ?>">
    <table>
	<input type="hidden" name="exercises[<?php echo $index; ?>]" value="<?php echo $index; ?>" />
	<tr>
	    <td>Name</td>
	    <td><input type="text" name="exercise_names[<?php echo $index; ?>]" value="<?php if (isset($name)) echo $name;?>" /></td>
	</tr>
	<tr>
	    <td>Description</td>
	    <td><input type="text" name="exercise_descriptions[<?php echo $index; ?>]" value="<?php if (isset($description)) echo $description; ?>" /></td>
	</tr>
	<tr>
	    <td colspan="2">
		<input type="button" onclick="removeExercise(<?php echo $index; ?>)" value="Remove" />
	    </td>
	</tr>
    </table>
    <table id="exercise_<?php echo $index; ?>_measurements">
    </table>
    <table>
	<tr>
	    <td><input type="button" value="Distance" onclick="addDistance(<?php echo $index; ?>)" /></td>
	    <td><input type="button" value="Count" onclick="addCount(<?php echo $index; ?>)" /></td>
	    <td><input type="button" value="Time" onclick="addTime(<?php echo $index; ?>)" /></td>
	</tr>
    </table>
</div>
