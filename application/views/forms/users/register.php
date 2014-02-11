<?php echo validation_errors(); ?>
<?php echo form_open('users/register'); ?>
<table>
    <tr>
	<td>Email*</td>
	<td><?php echo form_input('email', set_value('email')); ?></td>
    </tr>
    <tr>
	<td>First Name*</td>
	<td><?php echo form_input('firstname', set_value('firstname')); ?></td>
    </tr>
    <tr>
	<td>Last Name*</td>
	<td><?php echo form_input('lastname', set_value('lastname')); ?></td>
    </tr>
    <tr>
	<td>Password*</td>
	<td><?php echo form_password('password'); ?></td>
    </tr>
    <tr>
	<td>Confirm*</td>
	<td><?php echo form_password('confirm'); ?></td>
    <tr>
	<td colspan="2"><?php echo form_submit('submit','Register'); ?></td>
    </tr>
</table>
</form>

