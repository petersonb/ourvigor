<?php
echo validation_errors();
echo form_open('exercises/create');
$this->table->add_row('Name',form_input('name', set_value('name')));
$this->table->add_row('Description<br />(500 chars)', form_textarea('description', set_value('description')));
$this->table->add_row(form_submit('submit','Create Exercise'));

echo $this->table->generate();
?>
</form>
