<?php echo form_open("exerciselogs/delete/{$log['id']}"); ?>
<p><input type="checkbox" name="confirm" /> I am sure I want to delete this log.</p>
<br />
<input type="submit" value="Delete this Log" />
<?php echo form_close(); ?>
