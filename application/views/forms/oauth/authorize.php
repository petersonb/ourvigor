<?php echo form_open('oauth/auth?client_id='.$application['client_id']); ?>
<p><strong><?php echo $application['name']; ?></strong> would like your permision to access your account.</p>
<?php echo form_submit('allow','Allow'); ?>
</form>
