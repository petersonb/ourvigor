<h1>Your Exercises</h1>

<?php

if (isset($exercises))
{
	foreach ($exercises as $ex)
	{
		$this->table->add_row($ex['name'], $ex['description']);
	}
	echo $this->table->generate();
}
else
{
	echo "<h3>You don't have any exercises!</h3>";
}
?>
