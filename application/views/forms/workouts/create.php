<?php
echo validation_errors();
echo form_open('workouts/create');
$this->table->add_row('Name', form_input('name', set_value('name')));
$this->table->add_row('Description', form_input('description', set_value('description')));
$this->table->add_row(form_submit('submit', 'Create Workout'));
echo $this->table->generate();
?>
</form>
