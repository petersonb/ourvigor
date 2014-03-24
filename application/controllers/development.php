<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Development extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->user_id = $this->session->userdata('user_id');
	}

	public function index()
	{
		$data['content'] = 'development/main.php';
		$this->load->view('master', $data);
	}

	/*
	 * General Message
	 * --------------------------------------------------
	 * A page that allows users to submit a general
	 * development message.
	 * --------------------------------------------------
	 */
	public function general_message()
	{
		echo 'coming soon';
	}

	/*
	 * Learn
	 * --------------------------------------------------
	 * An about page about the technology used in this
	 * web application.
	 * --------------------------------------------------
	 */
	public function learn()
	{
		echo 'coming soon';
	}

	/*
	 * Log
	 * --------------------------------------------------
	 * Show development log from 'git log'
	 * --------------------------------------------------
	 */
	public function log()
	{
		$log = shell_exec('git log --pretty=format:"%ad %s" --date=short');
		$data['log'] = $log;

		$data['title'] = 'Git Log';
		$data['content'] = 'main/log';
		$this->load->view('master',$data);
	}

	/*
	 * Request Feature
	 * --------------------------------------------------
	 * A page where users can request new features of the
	 * web application.
	 * --------------------------------------------------
	 */
	public function request_feature()
	{
		if (!$this->user_id)
		{
			redirect('users/login?redirect_url=development/request_feature');
		}

		$this->load->library('form_validation');
		$this->load->helper('form');

		if (!$this->form_validation->run('development_request_feature'))
		{
			$user = new User($this->user_id);
			
			$profile = $user->profile;
			$profile->get();
			
			$data['user'] = array (
				'email' => $user->email,
				'phone' => $profile->phone
			);
			
			$data['success'] = FALSE;
		}
		else
		{
			$title   = $this->input->post('title');
			$phone   = $this->input->post('phone');
			$message = $this->input->post('message');
			
			$message = "[{$phone}] {$message}";
			$type    = "reqf";

			$this->submit_message($title,$message,$type);
			$data['success'] = TRUE;
		}
		$data['content'] = 'development/request_feature';
		$this->load->view('master', $data);
	}

	/*
	 * Submit Bug
	 * --------------------------------------------------
	 * Allows user to submit bugs to OurVigor
 	 * --------------------------------------------------
	 */
	public function submit_bug()
	{
		// User must be logged in
		if (!$this->user_id)
		{
			redirect('users/login?redirect_url=development/submit_bug');
		}

		$this->load->library('form_validation');
		$this->load->helper('form');
		
		if (!$this->form_validation->run('development_submit_bug'))
		{
			$user = new User($this->user_id);
			$data['user'] = array (
				'email' => $user->email
			);

			$data['success'] = FALSE;
			$data['content'] = 'development/submit_bug';
			$this->load->view('master', $data);
		}
		else
		{
			$user = new User($this->user_id);
			$type = 'bug';

			// Grab input
			$title    = $this->input->post('title');
			$location = $this->input->post('location');
			$phone    = $this->input->post('phone');
			$message  = $this->input->post('message');

			// Current date
			$date    = date('Y-m-d');
			// Message with location and phone
			$message = "({$location}) [{$phone}] $message";

			// Save development message
			$development_message = new DevelopmentMessage();
			$development_message->title    = $title;
			$development_message->date     = $date;
			$development_message->message  = $message;
			$development_message->type     = $type;
			$development_message->save($user);

			// TODO : Email development account
			
			// Show success page
			$data['success'] = TRUE;
			$data['content'] = 'development/submit_bug';
			$this->load->view('master', $data);
		}
	}

	///////////////////////////////////////////////////////////////////////////
	// Private Methods                                                       //
	///////////////////////////////////////////////////////////////////////////

	/*
	Submit Message
	--------------------------------------------------
	Since all development messages are submitted to
	the same database table, might as well save some
	of the trouble of saving development messages in
	each method.
	--------------------------------------------------
	 */
	private function submit_message($title,$message,$type)
	{
		if (!$this->user_id)
		{
			die();
		}
		
		$user = new User($this->user_id);

		$date = date('Y-m-d');

		// TODO : Email from here
		
		$development_message = new DevelopmentMessage();
		$development_message->title   = $title;
		$development_message->date    = $date;
		$development_message->message = $message;
		$development_message->type    = $type;
		$development_message->save($user);
	}
}

/* End of file development.php */
/* Location: ./application/controllers/development.php */
