<?php echo validation_errors(); ?>
<?php echo form_open('development/submit_bug'); ?>
<table>
    <tr>
	<td>Email</td>
	<td><?php echo $user['email']; ?></td>
    </tr>
    <tr>
	<td></td>
	<td><input type="checkbox" name="email_confirm" /> This email is correct</td>
    <tr>
	<td>Title</td>
	<td><input type="text" name="title" value="<?php echo set_value('title'); ?>" /></td>
	<td>What seems to be the problem?</td>
    </tr>
    <tr>
	<td>Location</td>
	<td><input type="text" name="location" value="<?php echo set_value('location'); ?>" /></td>
	<td>Please copy url of page error occured on here.</td>
    </tr>
    <tr>
	<td>Phone</td>
	<td><input type="text" name="phone" value="<?php echo set_value('phone'); ?>" /></td>
	<td>Only include if you would be willing to take a phone call.</td>
    </tr>
</table>
<h3>Message</h3>
<textarea name="message" style="resize:none; height : 200px; width : 500px;"><?php echo set_value('message'); ?></textarea>
<br />
<input type="submit" value="Submit Bug" />

<?php echo form_close(); ?>
