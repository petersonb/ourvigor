<?php echo validation_errors(); ?>
<?php echo form_open('fitness_profiles/welcome'); ?>
<h3>Initial Weight</h3>
<table>
    <tr>
	<td>Units</td>
	<td>
	    <select name="units">
		<option name="standard">Standard</option>
		<option name="metric">Metric</option>
	    </select>
	</td>
    </tr>
    <tr>
	<td>Current Height:</td>
	<td>
	    <select name="heightfeet">
		<option value="4">4</option>
		<option value="5" selected="selected">5</option>
		<option value="6">6</option>
	    </select>
	    <select name="heightinches">
		<?php for ($i = 0; $i < 13; $i++): ?>
		    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php endfor; ?>
	    </select>
	</td>
    </tr>
    <tr>
	<td>Current Weight:</td>
	<td><input style="width : 3em;" type="input" name="currentweight" />lbs</td>
    </tr>
    <tr>
	<td>Target Weight: </td>
	<td>
	    <input style="width : 3em;" type="input" name="targetweight" />lbs +/-
	    <select name="weightrange">
		<?php for ($i=0; $i<11; $i++): ?>
		    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
		<?php endfor; ?>
	    </select>
	    lbs
	</td>
    </tr>
</table>
