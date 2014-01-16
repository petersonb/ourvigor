<html>
    <head>
	<title><?php if (isset($title)) echo $title; ?></title>
    </head>
    <body>
	<?php
	// Load Menu
	$this->load->view('menus/development');
	
	// Load each content
	if (isset($content))
	{
		if (!is_array($content))
		{
			$content = array($content);
		}
		
		foreach ($content as $view)
		{
			$this->load->view("content/{$view}");
		}
	}
	?>
    </body>
</html>
