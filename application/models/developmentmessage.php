<?php


class DevelopmentMessage extends DataMapper {
	
	var $has_one = array('user');
		
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}


}

/* End of file developmentmessage.php */
/* Location: ./application/models/developmentmessage.php */
