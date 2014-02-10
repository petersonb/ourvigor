<?php

/*
Email Confirmation Model

This is a model for email confirmations.

When a new user is created, their email addresss
must be validated. Or, if a user changes their email,
it also must be revalidated.
*/
class EmailConfirmation extends DataMapper {
	
	var $has_one = array('user');
	var $has_many = array();
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
}

/* End of file template.php */
/* Location: ./application/models/emailconfirmation.php */
