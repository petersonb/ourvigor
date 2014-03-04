<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Goals extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}

	public function create()
	{
		$this->load->helper('form');

		$user = new User($this->user_id);
		$user_exercises = $user->exercise;
		$user_exercises->get();
		foreach ($user_exercises as $ex)
		{
			$exercises[$ex->id] = array (
				'id' => $ex->id,
				'name' => $ex->name,
				'description' => $ex->description
			);
		}
		
		$form_data = array(
			'exercises' => $exercises
		);
		
		$data['form_data'] = $form_data;
		
		$data['content'] = 'goals/create';
		$this->load->view('master',$data);
	}
	
}

/* End of file goals.php */
/* Location: ./application/controllers/goals.php */
