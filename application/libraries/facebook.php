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
	}
}
