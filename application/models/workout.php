<?php


class Workout extends DataMapper {
	
	var $has_one = array();
	var $has_many = array(
		'exercise'=>array('join_table'=>'workouts_exercises'),
		'user'=>array('join_table'=>'users_workouts'),
		'group'=>array('join_table'=>'groups_workouts'),
		'category'=>array('join_table'=>'workouts_categories')
	);
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}

/* End of file workout.php */
/* Location: ./application/models/workout.php */
