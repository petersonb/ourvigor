<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/REST_Controller.php');

class Users extends REST_Controller {

	public function __construct()
	{
		parent::__construct();
		$token_value = $this->get('token');

		$token = new Token();
		$token->where('value',$token_value);
		$token->get();

		if (!$token->exists())
		{
			$this->response(
				array(
					'error'=>'Invalid Token'
				)
			);
		}
		
		
		$this->user = $token->user;
		$this->application = $token->application;
	}

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


	public function me_get()
	{
		$user = $this->user->get();
		
		$this->response(
			array(
				'id'=>$user->id,
				'firstname'=>$user->firstname,
				'middlename'=>$user->middlename,
				'lastname'=>$user->lastname,
				'email'=>$user->email
			)
		);
	}
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */
