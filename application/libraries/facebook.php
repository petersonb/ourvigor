<?php

require_once('facebook/facebook.php');

class CI_Facebook {

	public function __construct()
	{
		$app_id     = "1452010535034540";
		$app_secret = "f675f5579a9c1631653147ddad693599";
		
		$config = array (
			'appId'              => $app_id,
			'secret'             => $app_secret,
			'fileUpload'         => FALSE,
			'allowSignedRequest' => FALSE
		);

		$this->facebook = new Facebook($config);
		$this->CI =& get_instance();
		
		$facebook_id         = $this->facebook->getUser();
		$user_id             = $this->CI->session->userdata('user_id');
		$session_facebook_id = $this->CI->session->userdata('facebook_id');


		$user_facebook_id = null;
		
		if ($user_id)
		{
			$user = new User($user_id);
			$user_facebook_id = $user->facebook_id;
		}

		if ($facebook_id && !$session_facebook_id && $user_facebook_id)
		{
			try {
				$user_info = $this->facebook->api('/me');
				$this->CI->session->set_userdata('facebook_id', $facebook_id);
			} catch (FacebookApiException $e){
				$facebook_id = null;
			}
		}

		if ($user_facebook_id && !$facebook_id)
		{
			redirect($this->getLoginUrl($user_id));
		}
	}

	public function getUser()
	{
		$id = $this->facebook->getUser();
		return $id;
	}

	public function getLoginUrl($user_id)
	{
		$params = array (
			'redirect_uri' => base_url("?user_id={$user_id}")
		);
		
		$url = $this->facebook->getLoginUrl($params);
		return $url;
	}

	public function logout()
	{
		if ($this->facebook->getUser())
		{
			$this->facebook->destroySession();
			$this->CI->session->unset_userdata('facebook_id');
		}
	}
}
