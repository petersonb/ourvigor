<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Oauth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}

	/*
	 * Auth
	 * --------------------------------------------------
	 * 
	 * This page handles the authorization of users.
	 * Applications can direct to this page along with a
	 * client_id in order to request the users's
	 * permission to have access to their information.
	 * 
	 * After the user allows authorization, a token will
	 * be sent to the redirect url of the application.
	 * --------------------------------------------------
	 */
	public function auth()
	{
		$client_id = $this->input->get('clent_id');

		$application = new Application();
		$application->client_id = $client_id;
		$application->get();

		if (!$application->exists())
		{
			$data['title'] = 'Auth Page';
			$data['content'] = 'oauth/noapplication';
			$this->load->view('master', $data);
		}

		elseif (!$this->user_id)
		{
			$redirect = 'users/login?redirect_url=oauth/auth?client_id='.$application->id;
			redirect($redirect);
		}
		elseif ($this->input->post())
		{
			$allow = $this->input->post('allow');

			if ($allow)
			{
				$user = new User($this->user_id);

				$existing_token = new Token();
				$existing_token->where('user_id',$user->id);
				$existing_token->where('application_id',$application->id);
				$existing_token->get();

				if ($existing_token->exists())
					$existing_token->delete();
				
				$token = $this->generate_token();
				$token->save(array($application,$user));

				die();
				echo 'here';
					     
			}
		}
		else
		{
			$this->load->helper('form');
			
			$data['application'] = array (
				'id'=>$application->id,
				'name'=>$application->name,
				'client_id'=>$application->client_id,
				'client_secret'=>$application->client_secret,
				'redirect_url'=>$application->redirect_url
			);
			
			$data['title'] = 'Auth Page';
			$data['content'] = 'oauth/authorize';
			$this->load->view('master',$data);
		}
	}
	
	/*
	 * Generate Token
	 * --------------------------------------------------
	 * 
	 * This method generates a unique token that can be
	 * saved to a user and application.
	 * --------------------------------------------------
	 */
	private function generate_token()
	{
		$length = 32;
		
		$value = '';
		$keys = array_merge(range(0,9),range('a','f'));
		

		for ($i = 0; $i < $length; $i++)
		{
			$value .= $keys[array_rand($keys)];
		}

		$check = new Token();
		$check->where('value',$value)->get();

		if ($check->exists())
			$token = $this->generate_token();

		$token = new Token();
		$token->value = $value;

		return $token;
	}
	
}

/* End of file oauth.php */
/* Location: ./application/controllers/oauth.php */
