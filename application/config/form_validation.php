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
			'rules' => 'required|max_length[32]|strip_tags'
		),
		array (
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'required|max_length[500]|strip_tags'
		),
	),
			

	//////////////////////////////////////////////////
	// Groups                                       //
	//////////////////////////////////////////////////

	'groups_create' => array(
		array (
			'field' => 'name',
			'label' => 'Group Name',
			'rules' => 'required|min_length[3]|max_length[64]|strip_tags',
		),
		array (
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'required|max_length[1000]|strip_tags',
		),
		array (
			'field' => 'visibility',
			'label' => 'Visibility',
			'rules' => 'required|strip_tags'
		),
		array (
			'field' => 'category',
			'label' => 'Category',
			'rules' => 'strip_tags'
		)
	),

	//////////////////////////////////////////////////
	// Users                                        //
	//////////////////////////////////////////////////

	'users_confirm_account' => array (
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|strip_tags'
		)
	),
	
	'users_login' => array (
		array (
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'required|strip_tags'
		),
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|strip_tags'
		)
	),
	
	'users_register' => array (
		array (
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'valid_email|required|is_unique[users.email]|strip_tags'
		),
		array (
			'field' => 'firstname',
			'label' => 'First Name',
			'rules' => 'required|min_length[2]|max_length[64]|alpha_dash|strip_tags'
		),
		array (
			'field' => 'lastname',
			'label' => 'Last Name',
			'rules' => 'required|min_length[2]|max_length[64]|alpha_dash|strip_tags'
		),
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required|min_length[8]|strip_tags'
		),
		array (
			'field' => 'confirm',
			'label' => 'Confirm',
			'rules' => 'matches[password]|strip_tags'
		)
	),

	//////////////////////////////////////////////////
	// Workouts                                     //
	//////////////////////////////////////////////////

	'workouts_create' => array (
		array (
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'required|max_length[30]|strip_tags'
		),
		array (
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'required|max_length[500]|strip_tags'
		),
		array (
			'field' => 'exercises',
			'label' => 'Exercises',
			'rules' => 'required|strip_tags'
		)
	),
	
);
