<?php


class Category extends DataMapper {
	
	var $has_one = array();
	var $has_many = array(
		'group'=>array('join_table'=>'groups_categories'),
		'exercise'=>array('join_table'=>'exercises_categories'),
		'workout'=>array('join_table'=>'workouts_categories')
	);
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}


}

/* End of file category.php */
/* Location: ./application/models/category.php */
