<?php

/*

*/
class ExerciseLog extends DataMapper {
	
	var $has_one = array('exercise');
	var $has_many = array();
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}

/* End of file exerciselog.php */
/* Location: ./application/models/exerciselog.php */
