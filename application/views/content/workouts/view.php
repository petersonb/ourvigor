<h1>View Workouts</h1>

<?php
foreach ($workouts as $wo)
{
	$this->table->add_row($wo['name'],$wo['description']);
}
echo $this->table->generate();
?>
