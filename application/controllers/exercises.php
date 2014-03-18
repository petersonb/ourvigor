<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exercises extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
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
		if (!$this->user_id)
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

			// Create a new exercise
			$exercise = new Exercise();
			$exercise->name = $name;
			if ($include_description)
			{
				$exercise->description = $description;
			}
			$exercise->save($user);

			// TODO redirect somewhere smart
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
	 * Log
	 * --------------------------------------------------
	 * 
	 * Log a single exercise. This is a page where the
	 * user is presented with 
	 * --------------------------------------------------
	 */
	public function log()
	{
		if (!$this->user_id)
		{
			redirect('users/login');
		}
		
		$this->load->library('form_validation');
		$this->load->helper(array('form','distance','time','date'));

		$user_exercises = array();
		if ($this->form_validation->run('exercises_log') == FALSE)
		{

			$user = new User($this->user_id);
			
			$exercises = $user->exercise;
			$exercises->get();


			foreach ($exercises as $exercise)
			{
				$user_exercises[$exercise->id] = array (
					'id' => $exercise->id,
					'name' => $exercise->name,
					'description' => $exercise->description
				);

			}
			$data['date'] = date("m/d/Y");
			$data['user_exercises'] = $user_exercises;
		}
		else
		{
			//////////////////////////////////////////////////
			// Get Data From Form                           //
			//////////////////////////////////////////////////
			
			$exercise_id = $this->input->post('exercise_id');
			$distance    = $this->input->post('distance');
			$time_hour   = $this->input->post('time_hour');
			$time_minute = $this->input->post('time_minute');
			$time_second = $this->input->post('time_second');
			$date        = $this->input->post('date');
			
			//////////////////////////////////////////////////
			// Convert Units                                //
			//////////////////////////////////////////////////
			
			$time_output    = time_seconds($time_hour, $time_minute, $time_second);
			$meter_distance = distance_miles_to_meters($distance);
			$mysql_date  = date_std_mysql($date);
			
			//////////////////////////////////////////////////
			// Log Exercise                                 //
			//////////////////////////////////////////////////
			
			$user     = new User($this->user_id);
			$exercise = $user->exercise;
			$exercise->where('id', $exercise_id);
			$exercise->get();
						
			$log = new ExerciseLog();
			$log->date     = $mysql_date;
			$log->distance = $meter_distance;
			$log->time     = $time_output;
			$log->save($exercise);

			redirect('exercises/view');
		}
		
		$data['title']      = 'Log Exercise';
		$data['content']    = 'exercises/log';
		$data['javascript'] = array('jquery','jquery-ui','date');
		$data['css']        = array('calendar_widget/jquery-ui');
		$this->load->view('master', $data);
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
		if (!$this->user_id)
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
					'date'     => date_mysql_std($log->date),
					'distance' => distance_meters_to_miles($log->distance),
					'time' => time_seconds_to_string($log->time)
				);
			}
			$data['exercises'][$ex->id] = array(
				'id' => $ex->id,
				'name' => $ex->name,
				'description' => $ex->description,
				'logs' => $log_array
			);
		}
		
		$data['title']   = 'View Exercises';
		$data['content'] = 'exercises/view';
		$this->load->view('master', $data);
	}

	public function welcome_intro()
	{
		if (!$this->user_id)
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
