<?php echo validation_errors(); ?>
<?php echo form_open('users/forgot_password'); ?>
<p>Please enter your email address belonging to your account below.</p>
<table>
    <tr>
	<td>Email</td>
	<td><input type="text" name="email" /></td>
    </tr>
</table>
<input type="submit" value="submit" />
<?php echo form_close(); ?>
