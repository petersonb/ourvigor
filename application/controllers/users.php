<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id         = $this->user_session->getUserId();
		$this->valid_logged_in = $this->user_session->isValidLoggedIn();
		$this->logged_in       = $this->user_session->isLoggedIn();
	}


	/*
	 * Index
	 * --------------------------------------------------
	 * 
	 * The main page for users.
	 * --------------------------------------------------
	 */
	public function index()
	{
		// Redirect if not logged in to login page.
		if (!$this->valid_logged_in)
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
	 * Confirm Account
	 * --------------------------------------------------
	 * 
	 * This method allows users to confirm their email
	 * address associated with their account.
	 * 
	 * --------------------------------------------------
	 */
	public function confirm_account()
	{

		$this->load->library('form_validation');
		
		$data['success'] = FALSE;
		
		if ($this->logged_in)
		{
			//////////////////////////////////////////////////
			// IF user is logged in                         //
			//   They should be coming directly from their  //
			//   email.                                     //
			//////////////////////////////////////////////////
			
			$email = $this->input->get('email');
			$code  = $this->input->get('confirm_code');

			$user  = new User($this->user_id);
			
			// Get user's email confirmation
			$econf = $user->emailconfirmation;
			$econf->get();
			
			// IF  econf actually exists
			// AND econf code matches provided code
			// AND econf email matches users email
			if($econf->exists() && $econf->code === $code && $econf->email === $user->email)
			{
				$econf->delete();
				$data['success'] = TRUE;
				$this->user_session->updateValidation();
			}
			else
			{
				redirect('users');
			}
			$data['logged_in'] = TRUE;
		}
		elseif ($this->form_validation->run('users_confirm_account'))
		{
			//////////////////////////////////////////////////
			// If not logged in, and form validation has    //
			// been run, log the user in provided they have //
			// proper credentials. The code should come     //
			// from post data from the special login form   //
			// used with confirming the account.            //
			//////////////////////////////////////////////////
			
			$email    = $this->input->post('email');
			$code     = $this->input->post('confirm_code');
			$password = $this->input->post('password');

			// Make sure email and password are valid login
			if ($this->valid_login($email, $password))
			{
				// Get user
				$user = new User();
				$user->where('email', $email);
				$user->get();

				// Log user in
				$this->session->set_userdata('user_id',$user->id);
				$this->user_id = $user->id;
				
				// Get user's email confirmation
				$econf = $user->emailconfirmation;
				$econf->get();
				
				// IF  econf actually exists
				// AND econf code matches provided code
				// AND econf email matches users email
				if($econf->exists() && $econf->code === $code && $econf->email === $user->email)
				{
					$econf->delete();
					$data['success'] = TRUE;
				}
				
				$data['logged_in'] = TRUE;
			}
		}
		else
		{
			//////////////////////////////////////////////////
			// Else: if not logged in, and not posting,     //
			//  there must be get data in url, or post      //
			//////////////////////////////////////////////////


			//////////////////////////////////////////////////
			// Catch failed login or initial non-logged in  //
			// user. Continue from there.                   //
			//////////////////////////////////////////////////
			if (!$this->input->post())
			{
				$email        = $this->input->get('email');
				$confirm_code = $this->input->get('confirm_code');
			}
			else
			{
				$email        = $this->input->post('email');
				$confirm_code = $this->input->post('confirm_code');
			}

			$econf = new EmailConfirmation();
			$econf->where('email',$email);
			$econf->where('code', $confirm_code);
			$econf->get();

			//////////////////////////////////////////////////
			// Bad code trial. Redirect them to norm login  //
			//////////////////////////////////////////////////
			
			if (!$econf->exists())
			{
				redirect('users/login');
			}

			$user = $econf->user;
			$user->get();

			//////////////////////////////////////////////////
			// Make suer user email is same as given email  //
			//////////////////////////////////////////////////
			
			if ($user->email !== $email)
			{
				
				redirect('users/login');
			}

			$data['user'] = array(
				'firstname' => $user->firstname,
				'email' => $user->email
			);
			
			// if not logged in
			$this->load->helper('form');
			
			$data['logged_in']    = FALSE;
			$data['email']        = $email;
			$data['confirm_code'] = $confirm_code;

		}
		$data['content'] = 'users/confirm_account';
		$data['email']   = $email;
		
		$this->load->view('master',$data);
	}

	/*
	 * Confirm Password Reset
	 * --------------------------------------------------
	 * Handle a password reset from users being directed
	 * from their email.
	 * --------------------------------------------------
	 */
	public function confirm_password_reset()
	{
		//////////////////////////////////////////////////
		// Grab Some input                              //
		//////////////////////////////////////////////////

		if (!$this->input->post())
		{
			$code  = $this->input->get('code');
			$email = $this->input->get('email');
		}
		else
		{
			$code  = $this->input->post('code');
			$email = $this->input->post('email');
		}

		//////////////////////////////////////////////////
		// Make sure they're legit                      //
		//////////////////////////////////////////////////

		// Have to have code and email in url params
		if (!$code || !$email)
		{
			redirect('main');
		}
		
		// Grab request by the code and make sure it exists
		$reset_request = new PasswordReset();
		$reset_request->where('code',$code);
		$reset_request->get();

		if (!$reset_request->exists())
		{
			redirect('main');
		}
		
		// Grab user from the reset request
		$user = $reset_request->user;
		$user->get();

		// Make sure the user exists (redundant) and make sure
		//   the provided email matches.
		if (!$user->exists() || $user->email != $email)
		{
			redirect('main');
		}

		//////////////////////////////////////////////////
		// Lets reset their password                    //
		//////////////////////////////////////////////////

		$this->load->library('form_validation');
		$this->load->helper('form');
		
		$data['code']  = $code;
		$data['email'] = $email;

		if (!$this->form_validation->run('users_confirm_password_reset'))
		{
			$data['content'] = 'users/reset_password';
			$this->load->view('master', $data);
		}
		else
		{
			// Just password, confirm matches in form validation
			$password = $this->input->post('password');

			$user->password = $password;
			$user->save();

			$reset_request->delete();

			$this->session->set_userdata('user_id', $user->id);
			redirect('users');
		}

	}

	public function email_quarentine()
	{
		if ($this->valid_logged_in)
		{
			redirect('users');
		}
		if (!$this->logged_in && !$this->valid_logged_in)
		{
			redirect('users/login');
		}

		$user = new User($this->user_session->user_id);

		$data['user'] = array (
			'email' => $user->email,
			
		);
		
		$data['content'] = 'users/email_quarentine';
		$this->load->view('master', $data);
	}

	public function facebook_register()
	{
		$facebook_user_id = $this->facebook->getUser();;
		if (!$this->valid_logged_in || !$facebook_user_id)
		{
			echo 'first';
			die();
			redirect('users/login');
		}

		if (!$this->session->userdata('facebook_register'))
		{
			echo 'second';
			die();
			redirect('users/login');
		}
					      
		$this->load->library('form_validation');
		$this->load->helper('form');

		$user = new User($this->user_id);
		
		if ($this->form_validation->run('users_facebook_register') == FALSE)
		{
			$data['user'] = array (
				'firstname' => $user->firstname,
				'lastname'  => $user->lastname,
				'email'     => $user->email,
			);
		}
		else
		{
			$password = $this->input->post('password');
			
			$user->password = $password;
			$user->save();

			$this->session->unset_userdata('facebook_register');
			redirect('users');
		}

		$data['content'] = 'users/facebook_register';
		$this->load->view('master', $data);
	}

	/*
	 * Find
	 * --------------------------------------------------
	 * 
	 * Find other users to connect with by searching.
	 * --------------------------------------------------
	 */

	public function find()
	{
		// Can't query users unless logged in
		if (!$this->valid_logged_in)
			redirect('users/login');
		
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

	public function forgot_password()
	{
		if ($this->logged_in)
		{
			redirect('users');
		}

		$this->load->library('form_validation');
		$this->load->helper('keygen','form');

		if (!$this->form_validation->run('users_forgot_password'))
		{
			$data['success'] = FALSE;
		}
		else
		{
			$email = $this->input->post('email');

			$user = new User();
			$user->where('email', $email);
			$user->get();

			if (!$user->exists())
			{
				redirect('main');
			}

			$this->send_forgot_password_email($user->id);

			$data['success'] = TRUE;
		}
		$data['content'] = 'users/forgot_password';
		$this->load->view('master', $data);
	}
	
	/*
	 * Register
	 * --------------------------------------------------
	 * 
	 * This method handles the creation of user accounts.
	 * User accounts must be created abiding by these
	 * fields and rules...
	 * 
	 * firstname - required | unique | valid
	 * firstname - required | len 2-64 | alpha_dash
	 * lastname  - same as first
	 * password  - required | len 8+
	 * confirm   - same as password
	 * --------------------------------------------------
	 */
	public function register()
	{
		if ($this->logged_in)
		{
			redirect('users');
		}
		$this->load->library('form_validation');
		
		$this->form_validation->set_message('is_unique', 'The desired eamil is already in use.');
		if ($this->form_validation->run('users_register') == FALSE)
		{
			$data['title']   = 'Register';
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
			$user->lastname  = $lastname;
			$user->email     = $email;
			$user->password  = $password;
			$user->save();
		 
		 
			// Log New User In
			if ($this->valid_login($email, $password))
			{			 
				$this->send_confirmation_email();
				
				$this->session->set_userdata('user_id',$user->id);
				$this->user_id = $user->id;
				redirect('exercises/welcome_intro');
			}
			else
			{
				echo "Whoops! Something whent wrong!";
				die();
			}
		}
	}

	/*
	 * Login
	 * --------------------------------------------------
	 * 
	 * A login page, or where you can post data to log in
	 * from other parts of the site.
	 * --------------------------------------------------
	 */
	public function login()
	{
		if ($this->logged_in && $this->valid_logged_in)
		{
			redirect('users');
		}
		elseif ($this->logged_in && !$this->valid_logged_in)
		{
			redirect('users/email_quarentine');
		}
		
		$this->load->library('form_validation');

		if ($this->form_validation->run('users_login') == FALSE)
		{

			$data['redirect_url'] = $this->input->get('redirect_url');
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

				//$this->session->set_userdata('user_id',$user->id);
				$this->user_session->login($user->id);
				
				$redirect = $this->input->get('redirect_url');

				if ($redirect)
				{
					redirect(base_url($redirect));
				}

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
	 * Logout
	 * --------------------------------------------------
	 * 
	 * This method logs out the current user by unsetting
	 * the current userdata 'user_id'.
	 * --------------------------------------------------
	 */
	public function logout()
	{
		$this->facebook->logout();
		$this->user_session->logout();
		redirect('main');
	}

	public function change_email()
	{
		if (!$this->logged_in)
		{
			redirect('users/login');
		}
		
		$this->load->library('form_validation');
		$this->load->helper('form');

		$this->form_validation->set_message('is_unique', 'The desired eamil is already in use.');
		
		$user = new User($this->user_id);
		
		$data['success'] = FALSE;
		
		if ($this->form_validation->run('users_change_email') == FALSE)
		{

		}
		else
		{
			$email = $this->input->post('email');
			$user->email = $email;
			$user->save();

			$this->send_confirmation_email();
			$data['success']=TRUE;
		}

		$data['user'] = array (
			'email' => $user->email
		);
		
		$data['content'] = 'users/change_email';
		$this->load->view('master', $data);
	}

	public function change_password()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');

		$data['success'] = FALSE;
		if ($this->form_validation->run('users_change_password'))
		{
			$user = new User($this->user_id);
			
			$current  = $this->input->post('current');
			$password = $this->input->post('password');
			
			if ($this->valid_login($user->email, $current))
			{
				$user = new User($this->user_id);
				$user->password = $password;
				$user->save();

				$data['success'] = TRUE;
			}
			else
			{
				$data['error_message'] = "Your current password is incorrect.";
			}
		}
		
		$data['content'] = 'users/change_password';
		$this->load->view('master', $data);
	}


	/*
	 * Confirmation Email
	 * --------------------------------------------------
	 * 
	 * Create a new email confirmation requirement and
	 * send to the user.
	 * 
	 * The user will follow the link in the email in
	 * order to confirm their email address. There is an
	 * attached code to the URL parameters that will
	 * confirm their email is valid.
	 * --------------------------------------------------
	 */
	private function send_confirmation_email()
	{
		// TODO : Make sure this is the right way to do this
		if (!$this->valid_logged_in)
		{
			return false;
		}
		$this->load->library('email');
		$this->load->helper('keygen');

		// Grab logged in user
		$user = new User($this->user_id);

		// Check for existing confirmation
		$check = $user->emailconfirmation;
		$check->get();
		if ($check->exists())
		{
			$econf = $check;
		}
		else
		{
			// Create a new EmailConfirmation
			$econf = new EmailConfirmation();
			$econf->code = keygen_generate(32);
			$econf->email = $user->email;
			$econf->save($user);
		}

		$this->user_session->updateValidation();
		
		$data['user'] = array(
			'firstname' => $user->firstname,
			'lastname' => $user->lastname,
		);

		$data['link'] = base_url('users/confirm_account') . '?email=' . urlencode($user->email) . '&code=' . urlencode($econf->code);
		
		$data['content'] = 'users/confirmation_email';								     
		$message = $this->load->view('email_master',$data, TRUE);

		$this->email->from('support@ourvigor.com', 'OurVigor Support');
		$this->email->to($user->email);
		$this->email->subject('OurVigor Confirmation Email');
		$this->email->message($message);
		$this->email->send();

		return TRUE;
	}


	/*
	 * Forgot Password Email
	 * --------------------------------------------------
	 * Send to user with parameter id a password reset
	 * request.
	 * --------------------------------------------------
	 */
	private function send_forgot_password_email($user_id)
	{
		$this->load->library('email');
		$this->load->helper('keygen');
		
		$user = new User($user_id);
		
		//////////////////////////////////////////////////
		// Generate a unique code                       //
		//////////////////////////////////////////////////
		
		$code = keygen_generate(64);
		
		$check = new PasswordReset();
		$check->where('code', $code);
		$check->get();
		
		while ($check->exists())
		{
			$code = keygen_generate(64);
			
			$check = new PasswordReset();
			$check->where('code', $code);
			$check->get();
		}

		$reset = $user->passwordreset;
		$reset->get();
		if ($reset->exists())
		{
			$reset->code = $code;
			$reset->save();
		}
		else
		{
			$reset = new PasswordReset();
			$reset->code = $code;
			$reset->save($user);
		}

		$this->user_session->set_account_invalid();

		$data['code'] = $reset->code;
		$data['user'] = array (
			'id'        => $user->id,
			'firstname' => $user->firstname,
			'lastname'  => $user->lastname,
			'email'     => $user->email
		);

		$data['content'] = 'password_reset';
		$message = $this->load->view('email_master', $data, true);

		$this->email->from('support@ourvigor.com', 'OurVigor Support');
		$this->email->to($user->email);
		$this->email->subject('OurVigor Password Reset');
		$this->email->message($message);
		$this->email->send();
	}

	/*
	 * Login
	 * --------------------------------------------------
	 * 
	 * This method takes the email and password of the
	 * potential user, then confirms if the login
	 * information provided is valid.
	 * 
	 * returns True if user is allowed to log in
	 * --------------------------------------------------
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
