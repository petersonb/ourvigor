<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class CI_User_session {

	public function __construct()
	{
		$this->CI =& get_instance();

		$this->user_id = $this->CI->session->userdata('user_id');
		$this->user_valid = $this->CI->session->userdata('user_valid');

		// TODO : temporary fix, inefficient on every page request
		$this->updateValidation();
	}

	public function getUserId()
	{
		return $this->user_id;
	}

	public function isLoggedIn()
	{
		if ($this->user_id)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	public function isValidLoggedIn()
	{
		if ($this->user_id && $this->user_valid)
		{
			
			return TRUE;
		}
		return FALSE;
	}

	public function login($user_id)
	{
		$this->user_id = $user_id;

		$user_valid = $this->validate();
		$this->stampLastLogin();
		
		$this->CI->session->set_userdata('user_id',$user_id);
		$this->CI->session->set_userdata('user_valid', $user_valid);
	}

	public function logout()
	{
		$this->CI->session->unset_userdata('user_id');
		$this->CI->session->unset_userdata('email_valid');
	}

	public function stampLastLogin()
	{
		if (!$this->user_id)
		{
			return FALSE;
		}
		else
		{
			$user = new User($this->user_id);
			$user->last_login = date('Y-m-d H:i:s');
			$user->save();
			return TRUE;
		}
	}

	public function updateValidation()
	{
		$user_valid = $this->validate();
		$this->CI->session->set_userdata('user_valid', $user_valid);
		$this->user_valid = $user_valid;
		return $user_valid;
	}

	public function validate()
	{
		$user = new User($this->user_id);
		$email_confirmation = $user->emailconfirmation;
		$email_confirmation->get();

		if ($email_confirmation->count() > 0)
		{
			$user_valid = FALSE;
		}
		else
		{
			$user_valid = TRUE;
		}

		return $user_valid;
	}
}

/* End of file User_session.php */
