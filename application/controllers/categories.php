<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categories extends CI_Controller {



	public function __construct()
	{
		parent::__construct();

		$this->user_id         = $this->user_session->getUserId();
		$this->valid_logged_in = $this->user_session->isValidLoggedIn();
		$this->logged_in       = $this->user_session->isLoggedIn();
	}

	/*
	Create
	--------------------------------------------------

	Create a new category.
	--------------------------------------------------

	public function create()
	{
		// Must be logged in
		if (!$this->user_id)
		{
			redirect('users/login');
		}

		$c = new Category();
		$c->name = 'Diet';
		$c->save();

	}
	*/
}

/* End of file categories.php */
/* Location: ./application/controllers/categories.php */
    
