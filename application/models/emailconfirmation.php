<?php

/*
Email Confirmation Model

This is a model for email confirmations.

When a new user is created, their email addresss
must be validated. Or, if a user changes their email,
it also must be revalidated.
*/
class EmailConfirmation extends DataMapper {

	var $validation = array (
		array(
			'field' => 'secret_code',
			'label' => 'Secret Code',
			'rules' => array('encrypt'),
			'type' => 'password'
		)
	);
	
	
	var $has_one = array('user');
	var $has_many = array();
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}
	

	
	function _encrypt($field)
	{
		if (!empty($this->{$field}))
		{
			if (empty($this->salt))
			{
				$this->salt = uniqid();
			}
			$this->{$field} = $this->salt . hash('sha256', $this->salt . $this->{$field});
		}
	}

}

/* End of file template.php */
/* Location: ./application/models/emailconfirmation.php */
