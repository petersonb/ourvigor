<?php

/*
User Model

This is the model used represent users.
 */

class User extends DataMapper {

	// Require the password to be encrypted
	var $validation = array (
		array(
			'field' => 'password',
			'label' => 'Password',
			'rules' => array('encrypt'),
			'type'  => 'password'
			),
		
		);

	var $has_one = array(
		'emailconfirmation'
	);
	var $has_many = array(
		'group'=>array('join_table'=>'users_groups'),
		'user' => array(
			'other_field'=>'buddy',
			'reciprocal'=> TRUE
		),
		'buddy'=>array(
			'class'=>'user',
			'other_field'=>'user',
			'reciprocal'=> TRUE
		),

		'token',
		'exercise' => array('join_table' => 'users_exercises'),
		'workout' => array('join_table' => 'users_workouts'),
		'category' => array('join_table' => 'workouts_categories')
	);

	//--------------------------------------------------
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}

	/*
	Login
	
	Returns true if a login is allowed given the correct
	email and password.
	 */
	function login()
	{
		$a = new User();

		// Find user by email
		$email = $this->email;
		$a->where('email',$email)->get();

		
		$pass = $a->password;

		$passFrag = substr($pass,0,13);
		
		$this->salt = $passFrag;
		$this->validate()->get();
		
		if ($this->exists())
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	/*
	Encrypt
	
	Password encryption function. Salts password with
	uniqid() and encrypts the rest. Passwords will be
	compared with hash.
	 */
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

/* End of file user.php */
/* Location: ./application/models/user.php */
