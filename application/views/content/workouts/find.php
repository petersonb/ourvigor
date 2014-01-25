<h1>Find Workouts</h1>
<?php $this->load->view('forms/workouts/find'); ?>

<?php
if (isset($workouts))
{
	foreach ($workouts as $workout)
	{
		$this->table->add_row($workout['name'], $workout['description']);
	}

	echo $this->table->generate();
}
?>
