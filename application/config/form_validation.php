<?php

/*
  Form Validation Configuration

  All form validation for controllers is
  stored and configured here.
*/

$config = array (
	
	'register_main' => array (
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
		)
		
	);