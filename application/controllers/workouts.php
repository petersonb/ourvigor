<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workouts extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user_id         = $this->user_session->getUserId();
		$this->valid_logged_in = $this->user_session->isValidLoggedIn();
		$this->logged_in       = $this->user_session->isLoggedIn();
	}

	
	/*
	 * Add Exercise
	 * --------------------------------------------------
	 * Add an exercise to a workout
	 * --------------------------------------------------
	 */
	public function add_exercise($workout_id, $exercise_id)
	{
		// Must be logged in
		if (!$this->valid_logged_in)
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
	 * Create
	 * --------------------------------------------------
	 *
	 * Create a new workout routine
	 *
	 * The page that feeds into this controller has
	 * dynamic exercise objects. These objects are read
	 * in through post data through the following fields.
	 *
	 * exercises - javascript assigned id's for each
	 *  exercise to associate the names and descriptions
	 *
	 * exercise_names - array of exercises indexed by the
	 *  above id's
	 *
	 * exercise_descriptions - array of exercise
	 * descriptions indexed by the above id's
	 *
	 * --------------------------------------------------
	 */
	public function create()
	{
		// Must be logged in
		if (!$this->valid_logged_in)
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
			$user = new User($this->user_id);
			
			// Grab workout information
			$workout_name = $this->input->post('name');
			$workout_description = $this->input->post('description');
			$exercises = $this->input->post('exercises');

			// Create and save workout object
			$workout = new Workout();
			$workout->name = $workout_name;
			$workout->description = $workout_description;

			
			$workout->save($user);
			
			if ($exercises)
			{
				$exercise_names = $this->input->post('exercise_names');
				$exercise_descriptions = $this->input->post('exercise_descriptions');
				
				foreach ($exercises as $exercise_id)
				{
					$exercise = new Exercise();
					$exercise->name = $exercise_names[$exercise_id];
					$exercise->description = $exercise_descriptions[$exercise_id];
					$exercise->save(array($workout,$user));
				}
			}
			redirect('workouts/view');
		}
	}

	/*
	 * Find
	 * --------------------------------------------------
	 *
	 * Find workouts to add to user's workouts.
	 * --------------------------------------------------
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
	 * View
	 * --------------------------------------------------
	 *
	 * User can view all of their workouts.
	 * --------------------------------------------------
	 */
	public function view($workout_id = null)
	{
		// TODO : This method needs cleaning and work (workouts/view)
		// User Login
		if (!$this->valid_logged_in)
		{
			redirect('users/login');
		}

		$this->load->library('table');

		$user = new User($this->user_id);

		// Grab user's workouts
		$workouts = $user->workout;

		// If an id is provided, get one particular workout
		if ($workout_id)
		{
			$workouts->where('id', $workout_id);
		}
		$workouts->get();

		// If this workout does not exist, get all workouts
		if ($workouts->exists() && $workout_id)
		{
			// get exercises for this workout
			$exercises = $workouts->exercise;
			$exercises->get();

			foreach ($exercises as $exercise)
			{
				$data['exercises'][$exercise->id] = array (
					'id' => $exercise->id,
					'name' => $exercise->name,
					'description' => $exercise->description
				);
			}
		}
		else
		{
			$workouts = $user->workout;
			$workouts->get();
		}
			

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
    
