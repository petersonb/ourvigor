<?php


class Token extends DataMapper {
	
	var $has_one = array('user','application');
	var $has_many = array();
	
	//--------------------------------------------------
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}


}

/* End of file token.php */
/* Location: ./token/models/token.php */
