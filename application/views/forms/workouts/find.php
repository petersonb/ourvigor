<?php
echo form_open('workouts/find');

$this->table->add_row('Search', form_input('search'), form_submit('submit', 'search'));

echo $this->table->generate();
?>
</form>
