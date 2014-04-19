<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');

class Exercises extends REST_Controller {

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

	public function index_get($id = null)
	{
		if (!$id)
		{
			$this->response (
				array (
					'error'=>'No Exercise ID'
				)
			);
		}

		$user = new User($this->user_id);

		$exercise = $user->exercise;
		$exercise->where('id', $id);
		$exercise->get();

		$this->response (
			$exercise->getData()
		);
	}

}

/* End of file exercises.php */
/* Location: ./application/controllers/exercises.php */
