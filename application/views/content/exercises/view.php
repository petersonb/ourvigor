<h1>Your Exercises</h1>

<?php

foreach ($exercises as $ex)
{
	$this->table->add_row($ex['name'], $ex['description']);
}
echo $this->table->generate();
?>
