<?php echo validation_errors(); ?>
<?php if (isset($error_message)) echo $error_message; ?>
<?php echo form_open('users/change_password'); ?>
<table>
    <tr>
	<td>Current Password</td>
	<td><input type="password" name="current" /></td>
    </tr>
    <tr>
	<td>New Password</td>
	<td><input type="password" name="password" /></td>
    </tr>
    <tr>
	<td>Confirm New</td>
	<td><input type="password" name="confirm" /></td>
    </tr>
</table>
<input type="submit" value="Change Password" />
<?php echo form_close(); ?>
