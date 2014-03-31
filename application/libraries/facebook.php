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

		$facebook_id = $this->facebook->getUser();

		if ($facebook_id)
		{
			try {
				$user_info = $this->facebook->api('/me');
			} catch (Exception $e){
				$facebook_id = null;
			}
		}

		if ($facebook_id)
		{
			var_dump($user_info);
			$user = new User();
			$user->where('facebook_id', $facebook_id);
			$user->get();

			if ($user->exists())
			{
				$this->session->set_userdata('user_id', $user->id);
			}
			else
			{
				$this->facebook->destroySession();
			}
		}
		echo $facebook_id;
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

	public function getUserToken($code)
	{
		$params = array (
			'code' => $code,
			'client_id' => $this->facebook->getAppId(),
			'client_secret' => $this->facebook->getAppSecret(),
			'redirect_uri' => base_url('fb')
		);
		$token = $this->facebook->api('oauth/access_token','GET',$params);

		return "({$token})";
	}

	public function logout()
	{
		if ($this->facebook->getUser())
		{
			$this->facebook->destroySession();
		}
	}
}
