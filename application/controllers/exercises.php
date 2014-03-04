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

	public function welcome_intro()
	{
		if (!$this->user_id)
		{
			redirect('users/login');
		}
		
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data['default_exercises'] = array(
			array (
				'name'=>'run',
				'label'=>'Running'
			),
			array (
				'name'=>'bike',
				'label'=>'Biking'
			),
			array (
				'name'=>'swim',
				'label'=>'Swimming'
			),
			array (
				'name'=>'walk',
				'label'=>'Walking',
			)
		);
		if ($this->form_validation->run('exercises_welcome_intro') == FALSE)
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
			
			
		}
		else
		{
			foreach ($data['default_exercises'] as $exercise)
			{
				echo $this->input->post($exercise['name']);
			}
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
