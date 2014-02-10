<?php

/*
  Form Validation Configuration

  All form validation for controllers is
  stored and configured here.
*/

$config = array (

	//////////////////////////////////////////////////
	// Exercises                                    //
	//////////////////////////////////////////////////

	'exercises_create' => array (
		array (
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|max_length[32]'
		),
		array (
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'required|max_length[500]'
		),
	),
			

	//////////////////////////////////////////////////
	// Groups                                       //
	//////////////////////////////////////////////////

	'groups_create' => array(
		array (
			'field' => 'name',
			'label' => 'Group Name',
			'rules' => 'required|min_length[3]|max_length[64]',
		),
		array (
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'required|max_length[1000]',
		),
		array (
			'field' => 'visibility',
			'label' => 'Visibility',
			'rules' => 'required'
		),
		array (
			'field' => 'category',
			'label' => 'Category',
			'rules' => ''
		)
	),

	//////////////////////////////////////////////////
	// Users                                        //
	//////////////////////////////////////////////////

	'users_confirm_account' => array (
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required'
		)
	),
	
	'users_login' => array (
		array (
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required'
		),
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required'
		)
	),
	
	'users_register' => array (
		array (
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'valid_email|required|is_unique[users.email]'
		),
		array (
			'field' => 'firstname',
			'label' => 'First Name',
			'rules' => 'required|min_length[2]|max_length[64]|alpha_dash'
		),
		array (
			'field' => 'lastname',
			'label' => 'Last Name',
			'rules' => 'required|min_length[2]|max_length[64]|alpha_dash'
		),
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[8]'
		),
		array (
			'field' => 'confirm',
			'label' => 'Confirm',
			'rules' => 'matches[password]'
		)
	),

	//////////////////////////////////////////////////
	// Workouts                                     //
	//////////////////////////////////////////////////

	'workouts_create' => array (
		array (
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|max_length[30]'
		),
		array (
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'required|max_length[500]'
		),
		array (
			'field' => 'exercises',
			'label' => 'Exercises',
			'rules' => 'required'
		)
	),
	
);
