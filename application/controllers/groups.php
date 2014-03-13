<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {



	public function __construct()
	{
		parent::__construct();

		//////////////////////////////////////////////////
		// DANGER - These values directly coded to      //
		//   database. Database must be updated if      //
		//   these are changed.                         //
		//////////////////////////////////////////////////
		
		$this->visibility_options = array(
			'0' => 'Only Members',
			'1' => 'Only Members and Fitness Buddies',
			'2' => 'Everyone'
		);

		//////////////////////////////////////////////////
		// END DANGER                                   //
		//////////////////////////////////////////////////
		

		$this->user_id = $this->session->userdata('user_id');
	}

	/*
	 * Create
	 * --------------------------------------------------
	 * 
	 * Create a new group assigned under the user.
	 * --------------------------------------------------
	 */
	public function create()
	{
		if (!$this->user_id)
			redirect('users/login');

		$this->load->library('form_validation');
		
		if ($this->form_validation->run('groups_create') == FALSE)
		{
			$this->load->library('table');

			$data['visibility_options'] = $this->visibility_options;
			
			// Load group creation form
			$data['title'] = "Create Group";
			$data['content'] = 'groups/create';
			$this->load->view('master',$data);
		}
		else
		{
			// Create group
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$visibility = $this->input->post('visibility');

			$group = new Group();
			$group->name = $name;
			$group->description = $description;
			$group->visibility = $visibility;

			$user = new User($this->user_id);

			$group->save($user);

			redirect("groups/view/{$group->id}");
		}
	}

	/*
	 * View All
	 * --------------------------------------------------
	 * 
	 * View all groups in a table. You can select one to
	 * view or edit if you are and admin.
	 * --------------------------------------------------
	 */
	public function view_all()
	{
		if (!$this->user_id)
		{
			redirect('users/login');
		}

		$this->load->library('table');

		// Grab current user's groups
		$user = new User($this->user_id);
		$groups = $user->group->get();

		// Load groups into data
		foreach ($groups as $group)
		{
			$data['groups'][$group->id] = array(
				'id' => $group->id,
				'name' => $group->name,
				'description' => $group->description,
				'visibility' => $group->visibility,
				'categories' => $group->categories
			);
		}
		
		$data['title'] = 'Groups';
		$data['content'] = 'groups/view_all';
		
		$this->load->view('master',$data);
	}
	
	/*
	 * View Group
	 * --------------------------------------------------
	 * 
	 * View a single group.
	 * --------------------------------------------------
	 */
	public function view($group_id = null)
	{
		if (!$group_id)
		{
			redirect('groups');
		}

		$group = new Group($group_id);

		if ($group->visibility < 1)
		{
			$user = new User($this->user_id);

			$test_group = new Group();
			$test_group = $user->group->where('id',$group_id)->get();

			if (!$test_group->exists())
				redirect('groups'); // TODO THIS ISN'T A PAGE
		}

		// TODO GROUP < 2 | Only Buddies

		$this->load->library('table');

		$data['group'] = array(
			'name'=>$group->name,
			'description' => $group->description,
			'visibility'  => $group->visibility,
			'categories'  => $group->categories
		);
		
		$data['tile'] = 'View Group | ';
		$data['content'] = 'groups/view';
		$this->load->view('master',$data);
	}
}

/* End of file groups.php */
/* Location: ./application/controllers/groups.php */
    
