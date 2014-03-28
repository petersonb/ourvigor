<?php


class PasswordReset extends DataMapper {

	var $has_one = array(
		'user'
	);
	
	function __construct($id = NULL)
	{
		parent::__construct($id);
	}

}

/* End of file passwordreset.php */
/* Location: ./application/models/passwordreset.php */
