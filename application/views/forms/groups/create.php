<?php echo validation_errors();

echo form_open('groups/create'); 

$this->table->add_row('Group Name*'  ,form_input('name',set_value('name')));
$this->table->add_row('Description*' ,form_textarea('description',set_value('description')));
$this->table->add_row('Visibility*', form_dropdown('visibility', $visibility_options, '2'));

$this->table->add_row(form_submit('submit','Create Group'));
echo $this->table->generate();
?>
</form>
