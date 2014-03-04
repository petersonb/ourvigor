<?php
/*
Variables
$default_exercises['name','label']
 */
?>
<?php echo validation_errors(); ?>
<?php echo form_open('exercises/welcome_intro'); ?>
<table>
    <?php foreach($default_exercises as $exercise): ?>
	<tr>
	    <td><input value="1" type="checkbox" name="<?php echo $exercise['name']; ?>" /></td>
	    <td><?php echo $exercise['label']; ?></td>
	</tr>
    <?php endforeach; ?>
</table>
<input type="submit" value="submit" name="submit" />
</form>
