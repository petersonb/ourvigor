<?php echo form_open("exercises/delete/{$exercise['id']}"); ?>
<p>Are you sure you want to delete this exercise and all of the logs that go with it?</p>
<h3>This cannot be undone!</h3>
<p><input type="checkbox" value="1" name="confirm" /> Yes, I'm sure I never want to see anything about this exercise or my logs for it again!</p>
<input type="submit" value="Confirm" />
<?php echo form_close(); ?>
