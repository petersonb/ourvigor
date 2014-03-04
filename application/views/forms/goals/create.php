<?php
$types = array(
	'Distance',
	'Count',
	'Weight',
	'Time'
);
?>

<?php echo form_open('goals/create'); ?>

<table>
    <tr>
	<td>Exercise</td>
	<td>
	    <select name="exercise">
		<?php foreach ($exercises as $ex): ?>
		    <option value="<?php echo $ex['id']; ?>"><?php echo $ex['name']; ?></option>
		<?php endforeach; ?>
	    </select>
	</td>
    </tr>
    <tr>
	<td>Type</td>
	<td>
	    <select name="goal_type">
		<?php foreach ($types as $type): ?>
		    <option value=""><?php echo $type; ?></option>
		<?php endforeach; ?>
	    </select>
	</td>
    </tr>
</table>
</form>
