<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workouts extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}

	/*
	Create
	--------------------------------------------------

	Create a new workout routine
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
		$this->load->library(array('form_validation', 'table'));
		$this->load->helper('form');
		
		if ($this->form_validation->run('workouts_create') == FALSE)
		{
			// No input, load page and form
			$data['title'] = 'Create Workout';
			$data['content'] = 'workouts/create';
			$this->load->view('master', $data);
		}
		else
		{
			// Grab Post Data
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			
			// Get current user
			$user = new User($this->user_id);

			// Create new workout and save to current user
			$workout = new Workout();
			$workout->name = $name;
			$workout->description = $description;
			$workout->save($user);

			// View all workouts for user
			// TODO view this workout?
			redirect('workouts/view');
		}
	}

	/*
	View
	--------------------------------------------------

	User can view all of their workouts.
	--------------------------------------------------
	 */
	public function view()
	{
		// User Login
		if (!$this->user_id)
		{
			redirect('users/login');
		}

		$this->load->library('table');
		
		// Grab user
		$user = new User($this->user_id);

		// Grab user's workouts
		$workouts = $user->workout;
		$workouts->get();

		// Build workout output
		foreach ($workouts as $wo)
		{
			$data['workouts'][$wo->id] = array (
				'id'=>$wo->id,
				'name'=>$wo->name,
				'description'=>$wo->description
			);
		}

		// Load Page
		$data['title'] = 'View Workouts';
		$data['content'] = 'workouts/view';
		$this->load->view('master',$data);
	}

}

/* End of file workouts.php */
/* Location: ./application/controllers/workouts.php */
    
