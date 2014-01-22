<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');

class Users extends REST_Controller {

	public function index_get()
	{
		$id = $this->get('id');
		
		$user = new User($id);


		
		$this->response(
			array(
				'id'=>$user->id,
				'firstname'=>$user->firstname,
				'lastname'=>$user->lastname,
				'email'=>$user->email
			)
		);
	}
	
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */
