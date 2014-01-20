<h1>Find Users</h1>

<?php
$this->load->view('forms/users/find');


if (isset($users))
{
	foreach ($users as $user) {
		$this->table->add_row($user['firstname'] . ' ' . $user['lastname'],$user['email']);
	}
	echo $this->table->generate();
}
