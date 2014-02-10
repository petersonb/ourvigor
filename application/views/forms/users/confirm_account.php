<?php echo form_open('users/confirm_account'); ?>
<table>
    <tr>
	<td>Password</td>
	<td><?php echo form_password('password'); ?></td>
	<td><?php echo form_submit('submit','Submit'); ?></td>
    </tr>
</table>
<?php echo form_hidden('email',$email); ?>
<?php echo form_hidden('confirm_code', $confirm_code); ?>
</form>
