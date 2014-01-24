<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Development extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->userdata('user_id');

		$this->universal_password = "pass";
	}

	public function index()
	{
		
	}

	public function simple_setup()
	{
		$u0 = $this->create_user('Brett','E','Peterson','bepeterson14@gmail.com');
		$u1 = $this->create_user('Tony','P','Stark', 'tstark@petersonb.com');
		$u2 = $this->create_user('Clark','G','Kent', 'superman@petersonb.com');
		$u3 = $this->create_user('Peter','J','Parker', 'spidey@petersonb.com');

		$g0 = $this->create_group('Super Strength Group','Group support for super strength',2);


		$cat = $this->create_category('Cardio');
		$cat1 = $this->create_category('Muscular Endurance');

		$ex0 = $this->create_exercise('Push-up', 'Make the ground move away from you');
		$ex1 = $this->create_exercise('Pull-up', 'Pull the sky towards you');

		$u0->save(array($ex0,$ex1));

		$g0->save(array($cat,$cat1));

		$g0->save(array($u1,$u2));

		echo 'Done :D';
	}

	public function api_testing()
	{
		$this->load->library('table');
		$user = $this->create_user("Gandalf","the","Gray","wizmaster@petersonb.com");
		$app = $this->create_application("Wizzap");
		$token = $this->create_token($user,$app);

		$this->table->add_row('Client_Secret',$app->client_secret);
		$this->table->add_row('User_Token', $token->value);
		echo $this->table->generate();
	}


	private function create_application($name)
	{

		$app = new Application();
		$app->name = $name;
		$app->client_id = 1;
		$app->client_secret = 12;
		$app->redirect_url = base_url('oauth/test_catch');
		$app->save();

		return $app;
	}

	private function create_category($name)
	{
		$cat = new Category();
		$cat->name = $name;
		$cat->save();

		return $cat;
	}

	private function create_exercise($name, $description)
	{
		$ex = new Exercise();
		$ex->name = $name;
		$ex->description = $description;
		$ex->save();

		return $ex;
	}

	private function create_group($name, $description, $visibility)
	{
		$group = new Group();
		$group->name = $name;
		$group->description = $description;
		$group->visibility = $visibility;
		$group->save();

		return $group;
	}
	

	private function create_user($first,$middle,$last,$email)
	{
		$user = new User();
		$user->firstname = $first;
		$user->middlename = $middle;
		$user->lastname = $last;
		$user->email = $email;
		$user->password = $this->universal_password;
		$user->save();

		return $user;
	}



	private function create_token($user, $application)
	{
		$token = new Token();
		$token->value = 123;
		$token->save(array($user, $application));

		return $token;
	}
}

/* End of file development.php */
/* Location: ./application/controllers/development.php */
