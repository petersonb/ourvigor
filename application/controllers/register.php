<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$this->load->library('form_validation');

		$error_existing_email = "The desired email is already in use.";

		$this->form_validation->set_message('is_unique',$error_existing_email);
		if ($this->form_validation->run('register_main') == FALSE)
		{
			$data['title'] = 'Register';
			$data['content'] = 'register/main';
			$this->load->view('master',$data);
		}
		else
		{
			$user = new User();
			$user->firstname = $this->input->post('firstname');
			$user->lastname  = $this->input->post('lastname');
			$user->email     = $this->input->post('email');
			$user->password  = $this->input->post('password');
			$user->save();
			
			echo 'success';
		}
	}
}

/* End of file register.php */
/* Location: ./application/controllers/register.php */