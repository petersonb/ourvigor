<?php echo validation_errors(); ?>
<?php echo form_open('development/request_feature'); ?>
<table>
    <tr>
	<td>Email</td>
	<td><?php echo $user['email']; ?></td>
    </tr>
    <tr>
	<td></td>
	<td><input type="checkbox" name="email_confirm" /> This email is correct</td>
    </tr>
    <tr>
	<td>Title</td>
	<td><input type="text" name="title" value="<?php echo set_value('title'); ?>" /></td>
	<td>What would you like me to make for you?</td>
    </tr>
    <tr>
	<td>Phone</td>
	<td><input type="text" name="phone" value="<?php if (set_value('phone')) echo set_value('phone'); else echo $user['phone']; ?>" /></td>
	<td>Only include if you would be willing to take a phone call.</td>
    </tr>
</table>
<h3>Your Idea</h3>
<textarea name="message" style="resize:none; height : 200px; width : 500px;"><?php echo set_value('message'); ?></textarea>
<br />
<input type="submit" value="Submit Idea" />

<?php echo form_close(); ?>
