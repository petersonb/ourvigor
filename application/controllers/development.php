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
