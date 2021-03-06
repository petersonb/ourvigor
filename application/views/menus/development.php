<?php
$menu_items = array(
	array (
		'link' => 'main',
		'label' => "Main Home"
	),
	array (
		'link' => 'exercises/create',
		'label' => 'Exercises Create'
	),
	array (
		'link' => 'exercises/view',
		'label' => 'Exercises View'
	),
	array (
		'link' => 'exercises/find',
		'label' => 'Exercises Find'
	),
	array (
		'link' => 'groups/create',
		'label' => 'Groups Create'
	),
	array (
		'link' => 'groups/view_all',
		'label' => 'Groups View All'
	),
	array (
		'link' => 'users',
		'label' => "User Home"
	),

	array (
		'link' => 'users/find',
		'label' => 'Users Find'
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
	array (
		'link' => 'workouts/create',
		'label' => 'Workouts Create'
	),
	array (
		'link' => 'workouts/find',
		'label' => 'Workotus Find'
	),
	array (
		'link' => 'workouts/view',
		'label' => 'Workouts View'
	),
	array (
		'link' => 'main/log',
		'label' => 'Development Log'
	),
		
);
?>

<div style="float:left; height:100%; width:200px; margin-right:10px; border-right:solid black 2px;">
    <h4> Development Menu </h4>
    <ul style="float:left; list-style: none;">
	<?php foreach ($menu_items as $item): ?>
	    <?php $fragged = explode('/',$item['link']);?>
	    <?php $current = $fragged[0]; ?>

	    <?php if (isset($previous) && $previous != $current) echo "<hr />"; ?>
	    <li>
		<a href="<?php echo base_url($item['link']); ?>"><?php echo $item['label']; ?></a>
	    </li>
	    <?php $previous = $current; ?>
	<?php endforeach; ?>
	<hr />
    </ul>
</div>
