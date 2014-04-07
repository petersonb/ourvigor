<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercises extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id         = $this->user_session->getUserId();
		$this->valid_logged_in = $this->user_session->isValidLoggedIn();
		$this->logged_in       = $this->user_session->isLoggedIn();
	}



	/*
	 * Create
	 * --------------------------------------------------
	 * 
	 * Create a new exercise and add to user's list of
	 * exercises.
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
		$this->load->library(array('form_validation','table'));
		$this->load->helper(array('form'));

		// If form validation fails, or is not run, load input form
		if ($this->form_validation->run('exercises_create') == FALSE)
		{
			$data['title']      = 'Create Exercise';
			$data['content']    = 'exercises/create';
			$data['javascript'] = array('jquery','exercises/create');
			$this->load->view('master',$data);
		}
		else
		{
			$user = new User($this->user_id);
			
			// Grab post data
			$name                = $this->input->post('name');
			$description         = $this->input->post('description');
			$include_description = $this->input->post('include_description');
			$types               = $this->input->post('type');

			$save_types = array (
				'dist' => FALSE,
				'time' => FALSE,
				'laps' => FALSE,
				'wght' => FALSE,
				'reps' => FALSE,
				'sets' => FALSE,
			);
			
			foreach ($types as $type)
			{
				$save_types[$type] = TRUE;
			}

			// Create a new exercise
			$exercise = new Exercise();
			$exercise->name = $name;
			if ($include_description)
			{
				$exercise->description = $description;
			}
			$exercise->distance    = $save_types['dist'];
			$exercise->time        = $save_types['time'];
			$exercise->weight      = $save_types['wght'];
			$exercise->repetitions = $save_types['reps'];
			$exercise->sets        = $save_types['sets'];
			$exercise->laps        = $save_types['laps'];

			$exercise->save($user);

			// TODO redirect somewhere smart
			redirect('exercises/view');
		}
	}

	/*
	 * Delete
	 * --------------------------------------------------
	 * Delete an exercise and all of its logs.
	 * --------------------------------------------------
	 */
	public function delete($exercise_id = null)
	{
		if (!$exercise_id || !$this->valid_logged_in)
		{
			redirect('exercises/view');
		}

		$this->load->helper('form');

		//////////////////////////////////////////////////
		// Load users and grab exercise from current    //
		// user to avoid mischief                       //
		//////////////////////////////////////////////////
		
		$user = new User($this->user_id);

		$exercise = $user->exercise;
		$exercise->where('id', $exercise_id);
		$exercise->get();

		if ($exercise->exists())
		{
			if (!$this->input->post())
			{
				//////////////////////////////////////////////////
				// Not handling submission                      //
				//////////////////////////////////////////////////
				
				$data['exercise'] = array(
					'id'          => $exercise->id,
					'name'        => $exercise->name,
					'description' => $exercise->description
				);
				
				$data['success'] = FALSE;
			}
			else
			{
				//////////////////////////////////////////////////
				// Handle submission                            //
				//////////////////////////////////////////////////
				
				$confirm = $this->input->post('confirm');

				//////////////////////////////////////////////////
				// If they check the submission box, delete all //
				// things to do witht this exercise.            //
				//                                              //
				// If not, lazy solution of just redirecting    //
				// back to the same page.                       //
				//////////////////////////////////////////////////
				if ($confirm)
				{

					$logs = $exercise->exerciselog;
					$logs->get();

					foreach ($logs as $log)
					{
						$log->delete();
					}

					$exercise->delete();

					$data['success'] = TRUE;
				}
				else
				{
					redirect("exercises/delete/{$exercise->id}");
				}
			}

			$data['content'] = 'exercises/delete';
			$this->load->view('master', $data);
		}
		else
		{
			redirect('exercises/view');
		}
	}

	/*
	 * Find
	 * --------------------------------------------------
	 * 
	 * Allow the user to find exercises they have not
	 * added to their list of exercises yet.
	 * --------------------------------------------------
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
	 * Modify
	 * --------------------------------------------------
	 * Modify an existing exercise
	 * --------------------------------------------------
	 */
	public function modify ($exercise_id = null)
	{
		// Must be logged in
		if (! $this->user_id)
		{
			redirect('users/login');
		}

		$this->load->library('form_validation');
		$this->load->helper('form');

		$user = new User($this->user_id);

		// Get exercise from user
		$exercise = $user->exercise;
		$exercise->where('id', $exercise_id);
		$exercise->get();

		// If exercise does not exist, redirect
		if (! $exercise->exists())
		{
			redirect('users/login');
		}
		
		
		// Form validation uses same as create
		
		if (! $this->form_validation->run('exercises_create'))
		{
			$data['exercise'] = $exercise->getData();
			
			$data['content']    = 'exercises/modify';
			$data['title']      = $exercise->name;
			$data['javascript'] = array('jquery', 'exercises/create');
			$this->load->view('master', $data);
		}
		else
		{
			$name                = $this->input->post('name');
			$description         = $this->input->post('description');
			$include_description = $this->input->post('include_description');
			$types               = $this->input->post('type');

			
			$save_types = array (
				'dist' => FALSE,
				'time' => FALSE,
				'laps' => FALSE,
				'wght' => FALSE,
				'reps' => FALSE,
				'sets' => FALSE,
			);
			
			foreach ($types as $type)
			{
				$save_types[$type] = TRUE;
			}
			
			
			$exercise->name        = $name;
			if ($include_description)
			{
				$exercise->description = $description;
			}
			else
			{
				$exercise->description = null;
			}

			$exercise->distance    = $save_types['dist'];
			$exercise->time        = $save_types['time'];
			$exercise->weight      = $save_types['wght'];
			$exercise->repetitions = $save_types['reps'];
			$exercise->sets        = $save_types['sets'];
			$exercise->laps        = $save_types['laps'];
			$exercise->save();

			redirect("exercises/view_one/{$exercise->id}");
		}	
	}
	
	/*
	 * View
	 * --------------------------------------------------
	 * 
	 * View exercises the uses has created, or has added
	 * to their list of exercises.
	 * --------------------------------------------------
	 */
	public function view()
	{
		if (!$this->valid_logged_in)
		{
			redirect('users/login');
		}

		$this->load->helper(array('distance','time','date'));

		$user = new User($this->user_id);

		$exercises = $user->exercise;
		$exercises->get();

		foreach ($exercises as $ex)
		{
			$logs = $ex->exerciselog;
			$logs->get();

			$log_array = array();
			foreach ($logs as $log)
			{
				$log_array[$log->id] = array (
					'id'       => $log->id,
					'date'     => date_mysql_std($log->date),
					'distance' => distance_meters_to_miles($log->distance),
					'time'     => time_seconds_to_string($log->time),
					'laps'     => $log->laps,
					'wght'     => $log->weight,
					'reps'     => $log->repetitions,
					'sets'     => $log->sets
				);
			}
			$data['exercises'][$ex->id] = array(
				'id' => $ex->id,
				'name' => $ex->name,
				'description' => $ex->description,
				'logs' => $log_array
			);

			$data['exercises'][$ex->id] = $ex->getData();
			$data['exercises'][$ex->id]['logs'] = $log_array;
		}

		$data['title']   = 'View Exercises';
		$data['content'] = 'exercises/view';
		$this->load->view('master', $data);
	}

	/*
	 * View One
	 * --------------------------------------------------
	 * View a single exercise
	 * --------------------------------------------------
	 */

	public function view_one($exercise_id = null)
	{
		// Must be logged in and exercise_id must be supplied
		if (!$this->valid_logged_in)
		{
			redirect('users/login');
		}

		if (!$exercise_id)
		{
			redirect('exercises/view');
		}

		$this->load->helper(array('time','distance','date'));

		// Get exercise from user
		$user = new User($this->user_id);

		$exercise = $user->exercise;
		$exercise->where('id', $exercise_id);
		$exercise->get();

		// Get exercise logs
		$exercise_logs = $exercise->exerciselog;
		$exercise_logs->get();
		$logs = array();


		$data = $exercise->getData();
		
		foreach ($exercise_logs as $log)
		{
			$logs[$log->id] = array (
				'id'       => $log->id,
				'date'     => date_mysql_std($log->date),
				'time'     => time_seconds_to_string($log->time),
				'distance' => distance_meters_to_miles($log->distance),
				'laps'     => $log->laps,
				'wght'     => $log->weight,
				'reps'     => $log->repetitions,
				'sets'     => $log->sets
			);
		}

		$data['exercise'] = $exercise->getData();
		$data['exercise']['logs'] = $logs;

		$data['title']   = $exercise->name;
		$data['content'] = 'exercises/view_one';
		$this->load->view('master', $data);
	}

	/*
	 * Welcome Intro
	 * --------------------------------------------------
	 * A welcome page where new users can select some
	 * pre-made exercises to immediately add to their
	 * exercises.
	 * --------------------------------------------------
	 */
	public function welcome_intro()
	{
		if (!$this->valid_logged_in)
		{
			redirect('users/login');
		}

		$this->load->library('form_validation');
		$this->load->helper('form');

		$default_exercises = array(
			array (
				'name'=>'run',
				'label'=>'Run'
			),
			array (
				'name'=>'bike',
				'label'=>'Bike'
			),
			array (
				'name'=>'swim',
				'label'=>'Swim'
			),
			array (
				'name'=>'walk',
				'label'=>'Walk',
			)
		);

		// TODO : this needs to be handled better
		if ($this->form_validation->run('exercises_welcome_intro') == FALSE)
		{
			$data['default_exercises'] = $default_exercises;
		}
		else
		{
			$user = new User($this->user_id);

			$run = $this->input->post('run');
			$bike = $this->input->post('bike');
			$swim = $this->input->post('swim');
			$walk = $this->input->post('walk');

			if ($run)
			{
				$run = new Exercise();
				$run->name = 'Run';
				$run->save($user);
			}

			if ($bike)
			{
				$bike = new Exercise();
				$bike->name = 'Bike';
				$bike->save($user);
			}

			if ($swim)
			{
				$swim = new Exercise();
				$swim->name = 'Swim';
				$swim->save($user);
			}

			if ($walk)
			{
				$walk = new Exercise();
				$walk->name = 'Walk';
				$walk->save($user);
			}

			// TODO : Change redirecet after welcome_intro
			redirect('exercises/view');
		}

		$data['title'] = 'Welcome';
		$data['content'] = 'exercises/welcome_intro';
		$this->load->view('master', $data);
	}

	public function load_create_form($index)
	{
		$data['index'] = $index;
		$this->load->view('dynamic/exercises/create',$data);
	}

	public function load_distance_widget($index)
	{
		$data['type'] = 'Distance';
		$data['units'] = array(
			'miles',
			'kilometers',
			'yards',
			'meters',
			'feet',
			'inches',
			'cm'
		);
		$data['index'] = $index;
		$this->load->view('dynamic/exercises/unit_view', $data);
	}

	public function load_count_widget($index)
	{
		$data['type'] = 'Count';
		$data['units'] = array(
			'Repetitions',
			'Sets',
			'Laps'
		);
		$data['index'] = $index;
		$this->load->view('dynamic/exercises/unit_view', $data);
	}

	public function load_time_widget($index)
	{
		$data['type'] = 'Time';
		$data['units'] = array (
			'Hours',
			'Minutes',
			'Seconds'
		);
		$data['index'] = $index;
		$this->load->view('dynamic/exercises/unit_view', $data);
	}
}

/* End of file exercises.php */
/* Location: ./application/controllers/exercises.php */
