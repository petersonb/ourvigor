<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}
	
	/*
	  Index
	  --------------------------------------------------

	  The Main page of the site.
	  --------------------------------------------------
	*/
	public function index()
	{
		$this->load->library('form_validation');
		
		$test['hi'] = 5;

		$data['content'] = array('main/home');
		$this->load->view('master',$data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */