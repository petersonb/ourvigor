<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		$this->load->view('api_message');
	}


	private function generate_key($size = null, $valid_chars = null)
	{
		$random_string = "";
	}
}

/* End of file api.php */
/* Location: ./application/controllers/api.php */
