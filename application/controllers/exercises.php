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
	Find
	--------------------------------------------------

	Allow the user to find exercises they have not
	added to their list of exercises yet.
	--------------------------------------------------
	*/
	public function find()
	{
		$this->load->library('table');
		$this->load->helper('form');

		if ($this->input->post())
		{
			$search = $this->input->post('search');

			// TODO do not get the current users's exercises
			$exercises = new Exercise();
			$exercises->or_like('name', $search);
			$exercises->or_like('description', $search);
			$exercises->get();
			
			foreach ($exercises as $ex)
			{
				$data['exercises'][$ex->id] = array (
					'id' => $ex->id,
					'name' => $ex->name,
					'description' => $ex->description
				);
			}
		}

		// Load Page
		$data['title'] = 'Find Exercises';
		$data['content'] = 'exercises/find';
		$this->load->view('master', $data);
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

		$this->load->library('table');

		$user = new User($this->user_id);

		$exercises = $user->exercise;
		$exercises->get();

		foreach ($exercises as $ex)
		{
			$data['exercises'][$ex->id] = array(
				'id' => $ex->id,
				'name' => $ex->name,
				'description' => $ex->description
			);
		}

		$data['title'] = 'View Exercises';
		$data['content'] = 'exercises/view';
		$this->load->view('master', $data);
	}

	public function load_create_form()
	{
		$this->load->library(array('table','form_validation'));
		$this->load->helper('form');
		$this->load->view('forms/exercises/create');
	}
}

/* End of file exercises.php */
/* Location: ./application/controllers/exercises.php */
