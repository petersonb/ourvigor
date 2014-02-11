<h1>View Workouts</h1>

<?php if (isset($workouts)): ?>
    <div class="workoutTable">
	<?php
	
	foreach ($workouts as $wo)
	{
		$this->table->add_row($wo['name'],$wo['description']);
	}
	$this->table->set_heading('Workout', 'Description');
	echo $this->table->generate();
	$this->table->clear();
	?>
    </div>
    <?php if (isset($exercises)): ?>
	<h3>Exercises</h3>
	<div class="exerciseTable">
	<?php

	foreach ($exercises as $ex)
	{
		$this->table->add_row($ex['name'], $ex['description']);
	}

	$this->table->set_heading('Exercise Name', 'Description');
	echo $this->table->generate();
	
	?>
	</div>
    <?php endif; ?>
    
<?php else: ?>
    
    <p>You have not created any workouts!
	
<?php endif; ?>
