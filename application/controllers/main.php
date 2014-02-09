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
		$this->load->helper('form');
		
		$data['content'] = array('main/home');
		$this->load->view('master',$data);
	}

	/*
	Log
	--------------------------------------------------

	Development log for those following along at home.
	--------------------------------------------------
	 */
	public function log()
	{


		$log = shell_exec('git log');
		$data['log'] = explode('commit',$log);

		$data['title'] = 'Git Log';
		$data['content'] = 'main/log';
		$this->load->view('master',$data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
