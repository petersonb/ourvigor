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
		}
	}
}
