<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');

class ExerciseLogs extends REST_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->user_id = $this->session->userdata('user_id');
		
		if (!$this->user_id)
		{
			$this->response (
				array (
					'error'=>'Not Logged In'
				)
			);
		}
	}

	public function exercise_get($id = null)
	{
		$user = new User($this->user_id);

		$exercise = new Exercise();
		$exercise->where('id', $id);
		$exercise->get();

		$logs = $exercise->exerciselog;
		$logs->get();

		$response = array();

		foreach ($logs as $log)
		{
			array_push($response,$log->getData());
		}
		
		$this->response (
			$response
		);
	}
}

/* End of file exerciselogs.php */
/* Location: ./application/controllers/exerciselogs.php */
