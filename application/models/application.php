<?php


/*
Application
--------------------------------------------------

This is the model used represent applications.
Applications are used to interact with the web
service through the Restful API.
--------------------------------------------------
 */

class Application extends DataMapper {
	
	var $has_one = array();
	var $has_many = array('token');

	
	//--------------------------------------------------
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}

/* End of file application.php */
/* Location: ./application/models/application.php */
