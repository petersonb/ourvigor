<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}


	/*
	Index
	--------------------------------------------------

	The main page for users.
	--------------------------------------------------
	 */
	public function index()
	{
		// Redirect if not logged in to login page.
		if (!$this->user_id)
		{
			redirect('users/login');
		}
		$user = new User($this->user_id);

		// Grab some userdata for shitz
		$data['user'] = array(
			'id'        => $user->id,
			'firstname' => $user->firstname,
			'lastname'  => $user->lastname,
			'email'     => $user->email
		);

		// Generate page
		$data['title'] = 'Users';
		$data['content'] = 'users/main';
		
		$this->load->view('master',$data);
	}

	/*
	Find
	--------------------------------------------------

	Find other users to connect with by searching.
	--------------------------------------------------
	 */

	public function find()
	{
		$this->load->helper('form');
		$this->load->library('table');
		if ($this->input->post())
		{
			$search = $this->input->post('search');

			$users = new User();
			$users->or_like('firstname',$search);
			$users->or_like('lastname',$search);
			$users->or_like('email',$search);
			$users->get();

			foreach ($users as $user)
			{
				$data['users'][$user->id] = array (
					'id' => $user->id,
					'firstname' => $user->firstname,
					'lastname' => $user->lastname,
					'email' => $user->email,
				);
				
			}
			
		}
		
		$data['title'] = 'Find Users';
		$data['content'] = 'users/find';
		$this->load->view('master',$data);
	}
	
	/*
	Register
	--------------------------------------------------
	
	This method handles the creation of user accounts.
	User accounts must be created abiding by these
	fields and rules...

	firstname - required | unique | valid
	firstname - required | len 2-64 | alpha_dash
	lastname  - same as first
	password  - required | len 8+
	confirm   - same as password
	--------------------------------------------------
	 */
	public function register()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_message('is_unique', 'The desired eamil is already in use.');
		if ($this->form_validation->run('users_register') == FALSE)
		{
			$data['title'] = 'Register';
			$data['content'] = 'users/register';
			$this->load->view('master',$data);
		}
		
		else
		{			
			
			// Grab post data
			$firstname = $this->input->post('firstname');
			$lastname  = $this->input->post('lastname');
			$email     = $this->input->post('email');
			$password  = $this->input->post('password');
		 
			// Build new user
			$user = new User();
			$user->firstname = $firstname;
			$user->lastname = $lastname;
			$user->email = $email;
			$user->password = $password;
			$user->save();
		 
			// Log New User In
			if ($this->valid_login($email, $password))
			{
			 
				// TODO : Send confirmation email
				
				$this->session->set_userdata('user_id',$user->id);
				redirect('users/index');
			}
			else
			{
				// TODO : Handle failed account creation better
				redirect('users/login');
			}
		}
	}

	/*
	Login
	--------------------------------------------------

	A login page, or where you can post data to log in
	from other parts of the site.
	--------------------------------------------------
	 */
	public function login()
	{
		$this->load->library('form_validation');

		if ($this->form_validation->run('users_login') == FALSE)
		{
			// Load Login Form
			$data['title'] = 'Log In';
			$data['content'] = 'users/login';
			$this->load->view('master',$data);
		}
		else
		{
			// Grab Login Info on Submit
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			if ($this->valid_login($email,$password))
			{
				// Log valid user in and redirect
				$user = new User();
				$user->where('email',$email)->get();

				$this->session->set_userdata('user_id',$user->id);

				redirect('users');
			}
			else
			{
				// Bring failed login to login page
				redirect('users/login');
			}
		}

		
	}
	
	/*
	Logout
	--------------------------------------------------

	This method logs out the current user by unsetting
	the current userdata 'user_id'.
	--------------------------------------------------
	 */
	public function logout()
	{
		$this->session->unset_userdata('user_id');

		redirect('main');
	}


	/*
	Login
	------------------------------------------------
	
	This method takes the email and password of the
	potential user, then confirms if the login
	information provided is valid.

	returns True if user is allowed to log in
	 */
	private function valid_login($email, $password)
	{
		$user = new User();
		$user->email    = $email;
		$user->password = $password;
		
		return $user->login();
	}


}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
