<?php echo validation_errors(); ?>
<?php echo form_open("exercises/modify/{$exercise['id']}"); ?>
<table>
    <tr>
	<td>Name*</td>
	<td>
	    <input type="text" name="name" value="<?php if (set_value('name')) echo set_value('name'); else echo $exercise['name']; ?>" />
	</td>
    </tr>
    <tr id="description_row">
	<td>Description<br />(500 chars)</td>
	<td>
	    <textarea id="description_textarea" name="description" style="resize:none"><?php if (set_value('description')) echo set_value('description'); else echo $exercise['description']; ?></textarea>
	</td>
    </tr>
</table>
<p id="toggle_description" style="cursor:pointer; color : #00F; text-decoration : underline;">Include Description</p>
<input type="submit" value="Save Exercise" />
<input type="hidden" id="include_description" name="include_description" value="1" />
<?php echo form_close(); ?>
