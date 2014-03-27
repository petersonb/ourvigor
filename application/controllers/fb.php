<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}

	public function index()
	{
		$code = $this->input->get('code');
		if ($this->input->post())
		{
			var_dump($this->input->post());
			die();
		}
		//echo $code;
		if ($code)
		{
			echo $this->facebook->getUserToken($code);
			//echo $this->facebook->getAccessToken();
		}
		else
		{
			echo $this->facebook->getUser();
		}
	}

	public function catch_token()
	{
		
	}
}

/* End of file fb.php */
/* Location: ./application/controllers/fb.php */
    
