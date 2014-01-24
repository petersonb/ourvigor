<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercises extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}



	/*
	Create
	--------------------------------------------------

	Create a new exercise and add to user's list of
	exercises.
	--------------------------------------------------
	 */
	public function create()
	{
		// Must be logged in
		if (!$this->user_id)
		{
			redirect('users/login');
		}
		
		// Load libraries and helpers
		$this->load->library(array('form_validation','table'));
		$this->load->helper('form');

		// If form validation fails, or is not run, load input form
		if ($this->form_validation->run('exercises_create') == FALSE)
		{
			$data['title'] = 'Create Exercise';
			$data['content'] = 'exercises/create';
			$this->load->view('master',$data);
		}
		else
		{
			$user = new User($this->user_id);
			
			// Grab post data
			$name = $this->input->post('name');
			$description = $this->input->post('description');

			// Create a new exercise
			$exercise = new Exercise();
			$exercise->name = $name;
			$exercise->description = $description;
			$exercise->save($user);

			// TODO redirect somewhere smart
			redirect('exercises/view');
		}
	}

	/*
	TODO Find
	--------------------------------------------------

	Allow the user to find exercises they have not
	added to their list of exercises yet.
	--------------------------------------------------
	
	public function find()
	{

	}

	/*
	
	View
	--------------------------------------------------

	View exercises the uses has created, or has added
	to their list of exercises.
	--------------------------------------------------
	 */
	public function view()
	{
		if (!$this->user_id)
		{
			redirect('users/login');
		}

		$user = new User($this->user_id);

		$exercises = $user->exercise;
		$exercises->get();
	}
}

/* End of file exercises.php */
/* Location: ./application/controllers/exercises.php */
