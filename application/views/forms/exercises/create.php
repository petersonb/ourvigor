<?php echo validation_errors(); ?>
<?php echo form_open('exercises/create'); ?>
<table>
    <tr>
	<td>Name*</td>
	<td>
	    <input type="text" name="name" value="<?php echo set_value('name'); ?>" />
	</td>
    </tr>
    <tr id="description_row">
	<td>Description<br />(500 chars)</td>
	<td>
	    <textarea id="description_textarea" name="description" style="resize:none"><?php echo set_value('description'); ?></textarea>
	</td>
    </tr>
</table>
<p id="toggle_description" style="cursor:pointer; color : #00F; text-decoration : underline;">Include Description</p>
<input type="submit" value="Create Exercise" />
<input type="hidden" id="include_description" name="include_description" value="1" />
<?php echo form_close(); ?>
