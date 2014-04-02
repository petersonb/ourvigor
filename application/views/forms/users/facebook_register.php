<?php echo validation_errors(); ?>
<?php echo form_open('users/facebook_register'); ?>
<table>
    <tr>
	<td>Password</td>
	<td><input type="password" name="password" /></td>
    </tr>
    <tr>
	<td>Confirm</td>
	<td><input type="password" name="confirm" /></td>
    </tr>
</table>
<input type="submit" value="save" />
<?php echo form_close(); ?>
