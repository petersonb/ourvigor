<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profiles extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');
	}

	public function view()
	{

	}

	public function edit()
	{
		if (!$this->user_id)
		{
			redirect('users/login');
		}
		$this->load->library(array('form_validation','table'));
		$this->load->helper('form');

		if ($this->form_validation->run('profiles_edit') == FALSE)
		{
			// Get current user
			$user = new User($this->user_id);

			// Get existing profile
			$profile = $user->profile;
			$profile->get();
			
			// Pack existing profile info for content
			if ($this->input->post())
			{
				$data['profile'] = array (
					'gender' => set_value('gender'),
					'date_of_birth' => set_value('date_of_birth'),
					'phone' => set_value('phone'),
					'phone_ext' => set_value('phone_ext'),
					'address_street_1' => set_value('street_1'),
					'address_street_2' => set_value('street_2'),
					'address_city' => set_value('city'),
					'address_state' => set_value('state'),
					'address_zip' => set_value('zip'),
					'about' => set_value('about')
				);
			}
			else
			{
				$data['profile'] = array (
					'gender' => $profile->gender,
					'date_of_birth' => $profile->date_of_birth,
					'phone' => $profile->phone,
					'phone_ext' => $profile->phone_ext,
					'address_street_1' => $profile->address_street_1,
					'address_street_2' => $profile->address_street_2,
					'address_city' => $profile->address_city,
					'address_state' => $profile->address_state_province,
					'address_zip' => $profile->address_zip,
					'about' => $profile->about
				);
			}

			// Pack user information for content
			$data['user'] = array (
				'firstname' => $user->firstname,
				'middlename' => $user->middlename,
				'lastname' => $user->lastname,
				'email' => $user->email,
			);

			$data['title'] = 'Edit Profile';
			$data['content'] = 'profiles/edit';
			$this->load->view('master',$data);
		}
		else
		{
			// Grab input
			$gender = $this->input->post('gender');
			$date_of_birth = $this->input->post('date_of_birth');
			$phone = $this->input->post('phone');
			$phone_ext = $this->input->post('phone_ext');
			$address_street_1 = $this->input->post('street_1');
			$address_street_2 = $this->input->post('street_2');
			$address_city = $this->input->post('city');
			$address_state = $this->input->post('state');
			$address_zip = $this->input->post('zip');
			$about = $this->input->post('about');


			// Get Current User
			$user = new User($this->user_id);
			
			// Get Existing Profile
			$profile = $user->profile;
			$profile->get();

			// If no existing profile
			
			if (!$profile->exists())
			{
				$profile = new Profile();
			}

			// Save Profile
			$profile->gender = $gender;
			$profile->date_of_birth = $date_of_birth;
			$profile->phone = $phone;
			$profile->phone_ext = $phone_ext;
			$profile->address_street_1 = $address_street_1;
			$profile->address_street_2 = $address_street_2;
			$profile->address_city = $address_city;
			$profile->address_state_province = $address_state;
			$profile->address_zip = $address_zip;
			$profile->about = $about;

			$profile->save($user);
		}
	}
}

/* End of file oauth.php */
/* Location: ./application/controllers/profiles.php */
