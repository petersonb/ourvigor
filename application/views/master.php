<!DOCTYPE html>
<html>
    <head>
	<?php
	// Load javascript
	if (isset($javascript))
	{
		if (!is_array($javascript))
		{
			$javascript = array($javascript);
			
		}
		
		foreach ($javascript as $js)
		{
			echo "<script type=\"text/javascript\" src=\"" . base_url("javascript/{$js}.js") . "\"></script>";
		}
	}
	?>
	<link rel="stylesheet" href="<?php echo base_url('css/master.css'); ?>" type="text/css" />
	<title><?php if (isset($title)) echo $title; ?></title>
    </head>
    <body>
	<div id="pageWrap">
	    <div id="header">
		<div id="innerHeader">
		    <h1>Fitness Header</h1>
		</div>
	    </div>
	    <div id="leftCol">
		<div id="menuCol">
		    <?php $this->load->view('menus/menu_bar.php'); ?>
		</div>
	    </div>
	    <div id="content">
		<div id="innerContent">
		    <?php
		    // Load Menu
		    //$this->load->view('menus/development');
		    
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
		</div>
	    </div>
	    <div id="footer">
		<div id="innerFooter">
		    <h3>Fitness Footer</h3>
		</div>
	    </div>
	</div>
    </body>
</html>
