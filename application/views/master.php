<!DOCTYPE html>
<html>
    <head>
	<?php if (isset($css)): ?>
	    <?php
	    if (!is_array($css))
	    {
		    $css = array($css);
	    }
	    ?>
	    
	    <?php foreach ($css as $css_item): ?>
		<link rel="stylesheet" href="<?php echo base_url("css/{$css_item}.css"); ?>" type="text/css" />
	    <?php endforeach; ?>	
	<?php endif; ?>
	
	<?php if (isset($javascript)): ?>
	    <?php
	    if (!is_array($javascript))
	    {
		    $javascript = array($javascript);
		    
	    }
	    ?>
	    
	    <?php foreach ($javascript as $js): ?>
		<script type="text/javascript" src="<?php echo base_url("javascript/{$js}.js"); ?>" . "\"></script>
	    <?php endforeach; ?>
	<?php endif; ?>
	<link rel="stylesheet" href="<?php echo base_url('css/master.css'); ?>" type="text/css" />
	<title>OurVigor<?php if (isset($title)) echo ' | '.$title; ?></title>
    </head>
    <body>
	<div id="pageWrap">
	    <div id="header">
		<?php $this->load->view('main/header'); ?>
	    </div>
	    <?php if ($this->user_id): ?>
		<div id="leftCol">
		    <?php $this->load->view('menus/menu_col.php'); ?>
		</div>
	    <?php endif; ?>
	    <div id="content">
		<div id="innerContent">
		    <?php
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
		<div class="contentSpacer">
		</div>
		<div id="innerFooter">
		    <?php $this->load->view('main/footer'); ?>
		</div>
	    </div>
	</div>
    </body>
</html>
