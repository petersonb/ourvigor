<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class CI_User_session {

	public function __construct()
	{
		$this->CI =& get_instance();
		$this->user_id = $this->CI->session->userdata('user_id');
		$this->valid_account = $this->CI->session->userdata('email_valid');
		
		if ($this->user_id && !$this->valid_account)
		{
			$user = new User($this->user_id);
			$conf = $user->emailconfirmation;
			$conf->get();

			if ($conf->count() > 0)
			{
				$this->CI->session->set_userdata('valid_account', FALSE);
				$this->valid_account = FALSE;
			}
			else
			{
				$this->CI->session->set_userdata('valid_account', TRUE);
				$this->valid_account = TRUE;
			}
		}

		if ($this->valid_account == FALSE)
		{
			$allowed_pages =  array (
				'users/email_quarentine',
				'users/change_email',
				'users/confirm_account'
			);
			
			$uri = uri_string();
			$uri_parts = explode('/', $uri);

			$valid = FALSE;
			foreach ($allowed_pages as $page)
			{
				$page_parts = explode('/', $page);
				
				if ($uri_parts[0] === $page_parts[0] && $uri_parts[1] === $page_parts[1])
				{
					$valid = TRUE;
					break;
				}
			}
			if ($valid == FALSE)
			{
				redirect('users/email_quarentine');
			}
		}
	}

	public function set_account_invalid()
	{
		$this->CI->session->set_userdata('valid_account', FALSE);
	}

	public function set_account_valid()
	{
		$this->CI->session->set_userdata('valid_account', TRUE);
	}
}

/* End of file User_session.php */
