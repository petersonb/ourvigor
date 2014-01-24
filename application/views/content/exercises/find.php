<h1>Find New Exercises</h1>
<?php $this->load->view('forms/exercises/find'); ?>
<?php
if (isset($exercises))
{
	foreach ($exercises as $ex)
	{
		$this->table->add_row($ex['name'], $ex['description']);
	}
	echo $this->table->generate();
}
?>
