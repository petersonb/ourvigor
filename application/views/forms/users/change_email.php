<?php echo validation_errors(); ?>
<?php echo form_open('users/change_email'); ?>
<table>
    <tr>
	<td>Current Email : </td>
	<td><?php echo $user['email']; ?></td>
    </tr>
    <tr>
	<td>Email</td>
	<td><input type="text" value="" name="email" /></td>
    </tr>
    <tr>
	<td>Confirm Email</td>
	<td><input type="text" name="confirm" /></td>
    </tr>
</table>
<input type="submit" value="change email" />
<?php echo form_close(); ?>
