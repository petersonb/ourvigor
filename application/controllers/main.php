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
		$get_user_id      = $this->input->get('user_id');
		$facebook_user_id = $this->facebook->getUser();
		if ($this->user_id && $this->session->userdata('facebook_id'))
		{
			redirect('users');
		}
		
		elseif($this->user_id)
		{
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
				redirect('fb/link_account');
			}
			else
			{
				redirect('fb/link_account');
			}
		}
		elseif(!$this->user_id && $get_user_id == 'register' && $facebook_user_id)
		{
			$facebook_user_info = $this->facebook->api('/me');
			var_dump($facebook_user_info);

			$user = new User();
			$user->where('email', $facebook_user_info['email']);
			$user->get();

			if ($user->exists())
			{
				//$this->facebook->logout();
				$data['error_head'] = 'Error : Existing User';
				$data['error_body'] = $this->load->view('content/errors/fb/existing_account',null, TRUE);
				$data['content'] = 'main/error_page';
				$this->load->view('master', $data);
			}

			else
			{
				$password = keygen_generate();
				
				$this->load->helper('keygen');
				$user = new User();
				$user->email       = $facebook_user_info['email'];
				$user->firstname   = $facebook_user_info['first_name'];
				$user->lastname    = $facebook_user_info['last_name'];
				$user->facebook_id = $facebook_user_id;
				$user->password    = $password;
				$user->save();

				$user = new User();
				$user->email = $facebook_user_info['email'];
				$user->password = $password;

				if ($user->login())
				{
					$this->session->set_userdata('user_id', $user->id);
					$this->user_id = $user->id;
					
					$this->session->set_userdata('facebook_register', TRUE);
					redirect('users/facebook_register');
				}
				else
				{
					echo 'fail';
					die();
					redirect('main');
				}
			}
		}

		else
		{
			$this->load->helper('form');
			
			$data['content'] = array('main/home');
			$this->load->view('master',$data);
		}
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
