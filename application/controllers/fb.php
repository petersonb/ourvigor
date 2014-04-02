<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user_id         = $this->user_session->getUserId();
		$this->valid_logged_in = $this->user_session->isValidLoggedIn();
		$this->logged_in       = $this->user_session->isLoggedIn();
	}

	public function index()
	{
		$user = $this->facebook->getUser();
		echo $user;
		if (!$user)
		{
			echo '<a href="'.$this->facebook->getLoginUrl().'">Login</a>';
		}
		else
		{
			echo 'success';
		}
	}

	/*
	 * Link Account
	 * --------------------------------------------------
	 * A page explaining what linking account does for
	 * the user, as well as a link to get them there.
	 * 
	 * If their account is already linked, they can unlink
	 * their account here as well.
	 * --------------------------------------------------
	 */
	public function link_account()
	{
		if (!$this->valid_logged_in)
		{
			redirect('users/login');
		}

		$linked = FALSE;
		if (!$this->facebook->getUser())
		{
			$data['link'] = $this->facebook->getLoginUrl($this->user_id);
		}
		else
		{
			$linked = TRUE;
			$data['link'] = base_url('fb/unlink_account');
		}
		
		$data['content'] = 'fb/link_account';
		$data['linked'] = $linked;
		$this->load->view('master', $data);
	}

	public function unlink_account()
	{
		$user = new User($this->user_id);
		$user->facebook_id = null;
		$user->save();

		$this->facebook->logout();
		redirect('fb/link_account');
	}

}

/* End of file fb.php */
/* Location: ./application/controllers/fb.php */
    
