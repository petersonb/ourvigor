<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/*
	   Register
	   --------------------------------------------------
	   
	   This method handles the creation of user accounts.
	   User accounts must be created abiding by these
	   fields and rules...

	   firstname - required | unique | valid
	   firstname - required | len 2-64 | alpha_dash
	   lastname  - same as first
	   password  - required | len 8+
	   confirm   - same as password
	   --------------------------------------------------
	 */
	public function register()
	{
		$this->load->library('form_validation');

		$error_existing_email = "The desired email is already in use.";

		$this->form_validation->set_message('is_unique',$error_existing_email);
		if ($this->form_validation->run('register_main') == FALSE)
		{
			$data['title'] = 'Register';
			$data['content'] = 'users/register';
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

/* End of file users.php */
/* Location: ./application/controllers/users.php */