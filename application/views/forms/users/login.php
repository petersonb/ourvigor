<?php
if (isset($redirect_url))
{
	echo form_open('users/login?redirect_url='.$redirect_url);
}
else
{
	echo form_open('users/login');
}
?>
<table>
    <tr>
	<td>Email</td>
	<td><?php echo form_input('email'); ?></td>
    </tr>
    <tr>
	<td>Password</td>
	<td><?php echo form_password('password'); ?></td>
    </tr>
    <tr>
	<td colspan="2"><?php echo form_submit('submit','Login'); ?></td>
    </tr>
</table>
</form>
