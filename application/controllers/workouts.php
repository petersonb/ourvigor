<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workouts extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}

	
	/*
	Add Exercise
	--------------------------------------------------
	Add an exercise to a workout
	--------------------------------------------------
	 */
	public function add_exercise($workout_id, $exercise_id)
	{
		// Must be logged in
		if (!$this->user_id)
		{
			redirect('users/login');
		}
		
		$user = new User($this->user_id);
		
		// User must have rights to workout
		$workout = $user->workout;
		$workout->where('id',$workout_id);
		$workout->get();

		// User must have rights to exercise
		$exercise = $user->exercise;
		$exercise->where('id',$exercise_id);
		$exercise->get();
		
		// If the workout and exercise belong to user
		if ($workout->exists() and $exercise->exists())
		{
			$workout->save($exercise);
			echo 'success';
		}
		else
		{
			echo 'fail';
		}

		
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
			$exercises = $this->input->post('exercises');
			$names = $this->input->post('exercise_names');
			$descriptions = $this->input->post('exercise_descriptions');

			$index = 0;
			
			if ($exercises)
			{
				foreach ($exercises as $exercise)
				{
					$index ++;
					$data['exercises'][$index] = array (
						'index' => $index,
						'name' => $names[$exercise],
						'description' => $descriptions[$exercise]
					);
				}
			}

			$data['exercise_index'] = $index;
			// No input, load page and form
			$data['title'] = 'Create Workout';
			$data['content'] = 'workouts/create';
			$data['javascript'] = array('jquery','workouts/create');
			$this->load->view('master', $data);
		}
		else
		{
			
		}
	}

	/*
	Find
	--------------------------------------------------

	Find workouts to add to user's workouts.
	--------------------------------------------------
	 */
	public function find()
	{
		$this->load->library('table');
		$this->load->helper('form');

		if ($this->input->post())
		{
			// Grab search string
			$search = $this->input->post('search');
			
			// Find related
			$workouts = new Workout();
			$workouts->or_like('name',$search);
			$workouts->or_like('description', $search);
			$workouts->get();

			// Load to data
			foreach ($workouts as $workout)
			{
				$data['workouts'][$workout->id] = array (
					'id' => $workout->id,
					'name' => $workout->name,
					'description' => $workout->description
				);
			}
		}

		// Load Page
		$data['title'] = 'Find Workouts';
		$data['content'] = 'workouts/find';
		$this->load->view('master', $data);
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
    
