<?php

/*
  Form Validation Configuration

  All form validation for controllers is
  stored and configured here.
*/

$password_creation_rules = 'required|min_length[8]';

$config = array (

	//////////////////////////////////////////////////
	// Development                                  //
	//////////////////////////////////////////////////

	'development_request_feature' => array (
		array (
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required|min_length[3]|max_length[50]'
		),
		array (
			'field' => 'phone',
			'label' => 'Phone',
			'rules' => ''
		),
		array (
			'field' => 'message',
			'label' => 'Message',
			'rules' => 'required|min_length[10]|max_length[1000]'
		),
		array (
			'field' => 'email_confirm',
			'label' => 'Email Confirmation',
			'rules' => 'required'
		)
	),


	'development_submit_bug' => array (
		array (
			'field' => 'title',
			'label' => 'Title',
			'rules' => 'required|min_length[3]|max_length[50]'
		),
		array (
			'field' => 'location',
			'label' => 'Location',
			'rules' => 'required|min_length[16]|max_length[64]'
		),
		array (
			'field' => 'phone',
			'label' => 'Phone',
			'rules' => ''
		),
		array (
			'field' => 'message',
			'label' => 'Message',
			'rules' => 'required|min_length[10]|max_length[1000]'
		),
		array (
			'field' => 'email_confirm',
			'label' => 'Email Confirmation',
			'rules' => 'required'
		)
	),
	
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
			'rules' => 'max_length[500]'
		),
	),

	'exercises_modify_log' => array (
		array (
			'field' => 'distance',
			'label' => 'Distance',
			'rules' => 'required|numeric'
		),
		array (
			'field' => 'time_hours',
			'label' => 'Hours',
			'rules' => 'numeric'
		),
		array (
			'field' => 'time_minutes',
			'label' => 'Minutes',
			'rules' => 'numeric'
		),
		array (
			'field' => 'time_seconds',
			'label' => 'Seconds',
			'rules' => 'numeric'
		),
	),

	'exercises_log' => array (
		array (
			'field' => 'distance',
			'label' => 'Distance',
			'rules' => 'required|numeric'
		),
		array (
			'field' => 'time_hours',
			'label' => 'Hours',
			'rules' => 'numeric'
		),
		array (
			'field' => 'time_minutes',
			'label' => 'Minutes',
			'rules' => 'numeric'
		),
		array (
			'field' => 'time_seconds',
			'label' => 'Seconds',
			'rules' => 'numeric'
		),
	),
	
	'exercises_welcome_intro' => array (
		array (
			'field' => 'submit',
			'label' => 'Submit',
			'rules' => 'required'
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
			'rules' => 'strip_tags'
		)
	),

	//////////////////////////////////////////////////
	// Profiles                                     //
	//////////////////////////////////////////////////

	'profiles_edit' => array(
		array (
			'field' => 'gender',
			'label' => 'Gender',
			'rules' => 'required|max_lenght[3]'
		),
		array (
			'field' => 'date_of_birth',
			'label' => 'Birth Date',
			'rules' => 'alpha_dash|exact_length[10]'
		),
		array (
			'field' => 'phone',
			'label' => 'Phone',
			'rules' => 'min_length[7]'
		),
		array (
			'field' => 'phone_ext',
			'label' => 'Phone Extension',
			'rules' => 'max_length[16]',
		),
		array (
			'field' => 'street_1',
			'label' => 'Street 1',
			'rules' => 'max_length[64]'
		),
		array (
			'field' => 'street_2',
			'label' => 'Street 2',
			'rules' => 'max_length[64]',
		),
		array (
			'field' => 'city',
			'label' => 'City',
			'rules' => 'max_length[32]',
		),
		array (
			'field' => 'state',
			'label' => 'Sate/Province',
			'rules' => 'max_length[32]'
		),
		array (
			'field' => 'zip',
			'label' => 'Zip',
			'rules' => 'max_length[16]'
		),
		array (
			'field' => 'about',
			'label' => 'About',
			'rules' => 'max_length[1000]'
		)
	),

	//////////////////////////////////////////////////
	// Users                                        //
	//////////////////////////////////////////////////

	'users_change_email' => array (
		array (
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'valid_email|required|is_unique[users.email]'
		),

		array (
			'field' => 'confirm',
			'label' => 'Confirm email',
			'rules' => 'matches[email]'
		)
	),

	'users_confirm_account' => array (
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'required'
		)
	),

	'users_confirm_password_reset' => array (
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

	'users_facebook_register' => array (
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => $password_creation_rules
		),
		array (
			'field' => 'confirm',
			'label' => 'Confirm',
			'rules' => 'matches[password]'
		)
	),

	'users_forgot_password' => array (
		array (
			'field' => 'email',
			'label' => 'Email',
			'rules' => 'valid_email|required'
		),	
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

	'users_change_password' => array (
		array (
			'field' => 'current',
			'label' => 'Current password',
			'rules' => 'required'
		),
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => $password_creation_rules
		),
		array (
			'field' => 'confirm',
			'label' => 'Confirm',
			'rules' => 'matches[password]'
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
			'rules' => $password_creation_rules
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
