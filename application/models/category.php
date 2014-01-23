<?php


class Category extends DataMapper {
	
	var $has_one = array();
	var $has_many = array(
		'group'=>array('join_table'=>'groups_categories')
	);
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}


}

/* End of file category.php */
/* Location: ./application/models/category.php */
