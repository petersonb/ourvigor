<?php


class Exercise extends DataMapper {
	
	var $has_one = array();
	var $has_many = array(
		'user' => array('join_table'=>'users_exercises'),
		'workout' => array('join_table'=>'workouts_exercises'),
		'group'=>array('join_table'=>'groups_exercises'),
		'exerciselog'
	);
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}

/* End of file exercise.php */
/* Location: ./application/models/exercise.php */
