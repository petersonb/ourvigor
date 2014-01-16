<?php
$menu_items = array(
	array (
		'link' => 'main',
		'label' => "Main Home"
	),
	array (
		'link' => 'users',
		'label' => "User Home"
	),

	array (
		'link' => 'users/login',
		'label' => "User Login"
	),

	array (
		'link' => 'users/register',
		'label' => "User Register"
	),

	array (
		'link' => 'users/logout',
		'label' => 'User Logout'
	),
		
);
?>

<div style="float:left; width:200px; margin-right:10px; border-right:solid black 2px;">
    <h4> Development Menu </h4>
    <ul style="float:left; list-style: none;">
	<?php foreach ($menu_items as $item): ?>
	    <?php $current = explode('/',$item['link'])[0]; ?>

	    <?php if (isset($previous) && $previous != $current) echo "<hr />"; ?>
	    <li>
		<a href="<?php echo base_url($item['link']); ?>"><?php echo $item['label']; ?></a>
	    </li>
	    <?php $previous = $current; ?>
	<?php endforeach; ?>
	<hr />
    </ul>
</div>
