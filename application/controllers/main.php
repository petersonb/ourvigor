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

	This page also handles linking facebook accounts.
	--------------------------------------------------
	 */
	public function index()
	{
		
		if (!$this->user_id)
		{
			redirect('users');
		}
		else
		{
			$get_user_id = $this->input->get('user_id');
			$facebook_user_id = $this->facebook->getUser();

			if ($facebook_user_id == '0')
			{
			}

			$user = new User();
			$user->where('facebook_id', $facebook_user_id);
			$user->get();

			//////////////////////////////////////////////////
			// If the user has not been linked              //
			//////////////////////////////////////////////////
			if (!$user->exists())
			{
				// Link the user
				$user = new User($this->user_id);
				$user->facebook_id = $facebook_user_id;
				$user->save();

				redirect('users');
			}
			else
			{
				redirect('users');
			}
		}

		$this->load->helper('form');
		
		$data['content'] = array('main/home');
		$this->load->view('master',$data);
	}

	public function style()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
		$data['content'] = 'style';
		$this->load->view('master',$data);
	}
}

/* End of file main.php */
/* Location: ./application/controllers/main.php */
