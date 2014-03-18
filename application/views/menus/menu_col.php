<ul>
    <li><a href="<?php echo base_url('main'); ?>">Home</a></li>
    <li>Profile</li>
    <ul>
	<li><a href="<?php echo base_url('profiles/view'); ?>">View</a></li>
	<li><a href="<?php echo base_url('profiles/edit'); ?>">Edit</a></li>
	<li><a href="<?php echo base_url('profiles/upload_profile_picture'); ?>">Upload Profile Picture</a></li>
    </ul>
    <li>Exercises</li>
    <ul>
    	<li><a href="<?php echo base_url('exercises/create'); ?>">Create</a></li>
	<li><a href="<?php echo base_url('exercises/view'); ?>">View</a></li>
	<li><a href="<?php echo base_url('exercises/log'); ?>">Log</a></li>
    </ul>
    <!-- 
    <li>Workouts</li>
    <ul>
	<li><a href="<?php echo base_url('workouts/create'); ?>">Create</a></li>
	<li><a href="<?php echo base_url('workouts/view'); ?>">View</a></li>
    </ul>
    <li>Goals</li>
    <ul>
	<li><a href="<?php echo base_url('goals/create'); ?>">Create</a></li>
    </ul>
    -->
    <li>About</li>
    <ul>
	<li><a href="<?php echo base_url('main/log'); ?>">Development Log</a></li>
    </ul>
    <li><a href="<?php echo base_url('users/logout'); ?>">Logout</a></li>
</ul>
