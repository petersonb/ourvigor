<?php


/*
  Group Model

  This is the model used represent grops.
 */

class Group extends DataMapper {

	var $has_one = array();
	var $has_many = array(
		'user' => array('join_table'=>'users_groups')
	);

	//--------------------------------------------------
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}

/* End of file grop.php */
/* Location: ./application/models/grop.php */
