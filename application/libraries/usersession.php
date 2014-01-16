<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Usersession {

	public function __construct()
	{
		$this->user_id = $this->session->userdata('user_id');
	}
}

/* End of file Someclass.php */