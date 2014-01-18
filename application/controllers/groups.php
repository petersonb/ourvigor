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
		// DANGER - Be very careful editing this code.  //
		//   This will cause bad things to happen in    //
		//   the database. These values are defined by  //
		//   a bit mask i.e. if you change their order, //
		//   or count, everything blows up that already //
		//   exists. You will have to change the entire //
		//   table to account for changes if you must   //
		//   change these.                              //
		//                                              //
		// P.S. If you don't know what a bit mask is,   //
		//      don't even look at this code until you  //
		//      understand it.                          //
		//////////////////////////////////////////////////
		
		$this->category_options = array(
			array(
				'value'=>'1',
				'name'=>'Cardiovascular',
			),
			array(
				'value'=>'2',
				'name'=>'Muscular Strength',
			),
			array(
				'value'=>'4',
				'name'=>'Muscular Endurance',
			),
			array(
				'value'=>'8',
				'name'=>'Flexibility',
			),
			array(
				'value'=>'16',
				'name'=>'Diet',
			),
			array(
				'value'=>'32',
				'name'=>'Other'
			)
		);

		//////////////////////////////////////////////////
		// END DANGER ZONE                              //
		//////////////////////////////////////////////////
		

		$this->user_id = $this->session->userdata('user_id');
	}

	/*
	  Create
	  --------------------------------------------------

	  Create a new group assigned under the user.
	  --------------------------------------------------
	 */
	public function create()
	{
		if (!$this->user_id)
			redirect('main');

		$this->load->library('form_validation');
		
		if ($this->form_validation->run('groups_create') == FALSE)
		{
			$this->load->library('table');

			$data['visibility_options'] = $this->visibility_options;
			$data['category_options'] = $this->category_options;

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
			$categories = $this->input->post('categories');

			$mask = 0;
			foreach ($categories as $category)
			{
				$mask += $category;
			}

			$group = new Group();
			$group->name = $name;
			$group->description = $description;
			$group->visibility = $visibility;
			$group->category = intval($mask);

			$user = new User($this->user_id);

			$group->save($user);

			redirect("groups/view_group/{$group->id}");
		}
	}

	/*
	  View Group
	  --------------------------------------------------

	  View a single group.
	  --------------------------------------------------
	*/
	public function view_group($group_id = null)
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
			'categories'  => $group->category
		);
		
		$data['tile'] = 'View Group | ';
		$data['content'] = 'groups/view';
		$this->load->view('master',$data);
	}
}

/* End of file groups.php */
/* Location: ./application/controllers/groups.php */
