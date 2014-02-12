<?php

/*
Profile

Profiles contain advanced user information for
the users.
*/
class Profile extends DataMapper {
	
	var $has_one = array('user');
	var $has_many = array();
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}

/* End of file template.php */
/* Location: ./application/models/emailconfirmation.php */
