<?php echo validation_errors(); ?>
<?php echo form_open('users/confirm_password_reset'); ?>
<table>
    <tr>
	<td>New Password </td>
	<td>
	    <input type="password" name="password" />
	</td>
    </tr>
    <tr>
	<td>Confirm Password</td>
	<td>
	    <input type="password" name="confirm" />
	</td>
    </tr>
</table>
<input type="submit" value="Reset Password" />
<input name="code"  type="hidden" value="<?php echo $code; ?>" />
<input name="email" type="hidden" value="<?php echo $email; ?>" />
<?php echo form_close(); ?>
