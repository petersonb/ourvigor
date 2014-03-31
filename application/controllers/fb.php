<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fb extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
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

	public function link_account()
	{
		if (!$this->user_id)
		{
			redirect('users/login');
		}
		echo '<a href="'.$this->facebook->getLoginUrl($this->user_id).'">Link</a>';
	}
}

/* End of file fb.php */
/* Location: ./application/controllers/fb.php */
    
