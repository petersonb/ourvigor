<h1>View Workouts</h1>

<?php if (isset($workouts)): ?>
    
    <?php
    
    foreach ($workouts as $wo)
    {
	    $this->table->add_row($wo['name'],$wo['description']);
    }
    
    echo $this->table->generate();
    
    ?>
    
    <?php if (isset($exercises)): ?>
	<h3>Exercises</h3>
	<?php
	
	foreach ($exercises as $ex)
	{
		$this->table->add_row($ex['name'], $ex['description']);
	}
	
	echo $this->table->generate();
	
	?>
	
    <?php endif; ?>
    
<?php else: ?>
    
    <p>You have not created any workouts!
	
<?php endif; ?>
