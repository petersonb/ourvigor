<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Workouts extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user_id         = $this->user_session->getUserId();
		$this->valid_logged_in = $this->user_session->isValidLoggedIn();
		$this->logged_in       = $this->user_session->isLoggedIn();
	}

}

/* End of file workouts.php */
/* Location: ./application/controllers/workouts.php */
    
