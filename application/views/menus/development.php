<?php
$menu_items = array(
	array (
		'link' => base_url('main'),
		'label' => "Main Home"
	),
	array (
		'link' => base_url('users'),
		'label' => "User Home"
	),

	array (
		'link' => base_url('users/login'),
		'label' => "User Login"
	),

	array (
		'link' => base_url('users/register'),
		'label' => "User Register"
	),

	array (
		'link' => base_url('users/logout'),
		'label' => 'User Logout'
	),
		
);
?>

<div style="float:left; height:100pc; width:200px; margin-right:10px; border-right:solid black 2px;">
    <h4> Development Menu </h4>
    <ul style="float:left; list-style: none;">
	<?php foreach ($menu_items as $item): ?>
	    <li>
		<a href="<?php echo $item['link']; ?>"><?php echo $item['label']; ?></a>
	    </li>
	<?php endforeach; ?>
    </ul>
</div>
