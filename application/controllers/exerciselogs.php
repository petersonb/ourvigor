<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExerciseLogs extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id         = $this->user_session->getUserId();
		$this->valid_logged_in = $this->user_session->isValidLoggedIn();
		$this->logged_in       = $this->user_session->isLoggedIn();
	}

	/*
	 * Delete
	 * --------------------------------------------------
	 * Delete an existing exercise log
	 * --------------------------------------------------
	 */
	public function delete($log_id = null)
	{
		//////////////////////////////////////////////////
		// Security                                     //
		//////////////////////////////////////////////////
		
		if (!$this->user_id)
		{
			redirect('users/login');
		}
		
		if (!$log_id)
		{
			redirect('exercises/view');
		}

		$log = new ExerciseLog($log_id);
		$exercise = $log->exercise;
		$exercise->get();

		$user = new User($this->user_id);
		$user_exercise = $user->exercise;
		$user_exercise->where('id', $exercise->id);
		$user_exercise->get();

		if (!$user_exercise->exists())
		{
			redirect('exercises/view');
		}

		//////////////////////////////////////////////////
		// End Security                                 //
		//////////////////////////////////////////////////

		$this->load->helper('form');

		if ($this->input->post() == FALSE)
		{
			
			$data['log'] = array (
				'id' => $log->id
			);
			
			$success = FALSE;
		}
		else
		{
			$log->delete();			
			$confirm = $this->input->post('confirm');
			$success = TRUE;
		}

		$data['success'] = $success;

		$data['content'] = 'exerciselogs/delete';
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
	public function log($exercise_id = null)
	{
		//////////////////////////////////////////////////
		// Security                                     //
		//////////////////////////////////////////////////
		
		if (!$this->valid_logged_in)
		{
			redirect('users/login');
		}

		$user = new User($this->user_id);

		$exercise = $user->exercise;
		$exercise->where('id', $exercise_id);
		$exercise->get();

		if ($exercise->exists() == FALSE)
		{
			redirect('exercises/view');
		}

		//////////////////////////////////////////////////
		// End Security                                 //
		//////////////////////////////////////////////////
		
		$this->load->library('form_validation');
		$this->load->helper(array('form','distance','time','date'));

		$user_exercises = array();
		if ($this->form_validation->run('exercises_log') == FALSE)
		{
			$data['exercise'] = $exercise->getData();

			$data['date'] = date("m/d/Y");
			$data['user_exercises'] = $user_exercises;
		}
		else
		{
			//////////////////////////////////////////////////
			// Get Data From Form                           //
			//////////////////////////////////////////////////
			
			//$exercise_id  = $this->input->post('exercise_id');
			$date         = $this->input->post('date');
			$time_hours   = $this->input->post('time_hours');
			$time_minutes = $this->input->post('time_minutes');
			$time_seconds = $this->input->post('time_seconds');
			$distance     = $this->input->post('distance');
			$laps         = $this->input->post('laps');
			$wght         = $this->input->post('wght');
			$reps         = $this->input->post('reps');
			$sets         = $this->input->post('sets');
			
			//////////////////////////////////////////////////
			// Convert Units                                //
			//////////////////////////////////////////////////
			
			$time_output    = time_seconds($time_hours, $time_minutes, $time_seconds);
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
			$log->date        = $mysql_date;
			$log->time        = $time_output;
			$log->distance    = $meter_distance;
			$log->laps        = $laps;
			$log->weight      = $wght;
			$log->repetitions = $reps;
			$log->sets        = $sets;
			$log->save($exercise);

			redirect('exercises/view');
		}
		
		$data['title']      = 'Log Exercise';
		$data['content']    = 'exerciselogs/log';
		$data['javascript'] = array('jquery','jquery-ui','date');
		$data['css']        = array('calendar_widget/jquery-ui');
		$this->load->view('master', $data);
	}


	/*
	 * Modify Log
	 * --------------------------------------------------
	 * Modify a logged exercise.
	 * 
	 * TODO : Move this to log controller
	 * --------------------------------------------------
	 */
	public function modify($log_id = null)
	{
		//////////////////////////////////////////////////
		// Security                                     //
		//////////////////////////////////////////////////

		// Must be logged in
		if (!$this->valid_logged_in)
		{
			redirect('users/login');
		}

		// Must have log_id in url
		if (!$log_id)
		{
			redirect('exercises/view');
		}

		$log = new ExerciseLog($log_id);

		// Log must exist
		if (!$log->exists())
		{
			redirect('exercises/view');
		}

		// Exercise from log
		$exercise = $log->exercise;
		$exercise->get();

		// User from exercise
		$user = $exercise->user;
		$user->get();

		// User id from exercise must match logged in user
		if ($user->id != $this->user_id)
		{
			redirect('exercises/view');
		}

		//////////////////////////////////////////////////
		// End Security                                 //
		//////////////////////////////////////////////////

		$this->load->helper(array('date','distance','form','time'));
		$this->load->library('form_validation');

		if ($this->form_validation->run('exercises_modify_log') == FALSE)
		{
			$data['exercise'] = $exercise->getData();
			
			$data['log']      = array (
				'id'       => $log->id,
				'date'     => date_mysql_std($log->date),
				'time'     => time_seconds_to_units($log->time),
				'distance' => distance_meters_to_miles($log->distance),
				'laps'     => $log->laps,
				'wght'     => $log->weight,
				'reps'     => $log->repetitions,
				'sets'     => $log->sets
			);
			
			$data['content'] = 'exerciselogs/modify';
			$data['javascript'] = array('jquery','jquery-ui','date');
			$data['css']        = array('calendar_widget/jquery-ui');
			$this->load->view('master', $data);
		}
		else
		{
			$date         = $this->input->post('date');
			$time_hours   = $this->input->post('time_hours');
			$time_minutes = $this->input->post('time_minutes');
			$time_seconds = $this->input->post('time_seconds');
			$distance     = $this->input->post('distance');
			$laps         = $this->input->post('laps');
			$wght         = $this->input->post('wght');
			$reps         = $this->input->post('reps');
			$sets         = $this->input->post('sets');

			$log->distance    = distance_miles_to_meters($distance);
			$log->time        = time_seconds($time_hours, $time_minutes, $time_seconds);
			$log->date        = date_std_mysql($date);
			$log->laps        = $laps;
			$log->weight      = $wght;
			$log->repetitions = $reps;
			$log->sets        = $sets;
			$log->save();

			redirect('exercises/view');
		}
	}
}

/* End of file exerciselogs.php */
/* Location: ./application/controllers/exerciselogs.php */
