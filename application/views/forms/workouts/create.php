<?php
echo validation_errors();
echo form_open('workouts/create');
$this->table->add_row('Name', form_input('name', set_value('name')));
$this->table->add_row('Description', form_input('description', set_value('description')));
//$this->table->add_row(form_submit('submit', 'Create Workout'));
echo $this->table->generate();
?>
<h3>Add Exercises</h3>
<div id="exerciseTable">
<?php
if (isset($exercises))
{
	foreach ($exercises as $exercise)
	{
		$this->load->view('dynamic/exercises/create.php', $exercise);
	}
}
?>
</div>
<input type="button" value="Add Exercise" onclick="addExercise()" />
<input type="hidden" value="<?php echo $exercise_index; ?>" name="exercise_count" id="exerciseCount" />
<input type="submit" value="Submit" />
</form>
