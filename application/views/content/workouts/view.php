<h1>View Workouts</h1>

<?php
if (isset($workouts))
{
	foreach ($workouts as $wo)
	{
		$this->table->add_row($wo['name'],$wo['description']);
	}
	echo $this->table->generate();
}
else
{
	echo '<h3> You have not created or added any workouts.</h3>';
}
?>
