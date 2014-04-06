<div style="float:left">
    <img class="profilePictureViewProfile" src="<?php echo base_url("uploads/profile_pictures/profile_pic_{$user['id']}.png"); ?>" />
    <br />
    <a href="<?php echo base_url('profiles/upload_profile_picture'); ?>">Upload Profile Picture</a>
    <br />
    <a href="<?php echo base_url('users/change_password'); ?>">Change Password</a>
    <br />
    <a href="<?php echo base_url('users/change_email'); ?>">Change Email</a>
    <br />
    <a href="<?php echo base_url('profiles/edit'); ?>">Edit Profile</a>
    <br />
    <a href="<?php echo base_url('fb/link_account'); ?>">Facebook</a>
</div>

<br />
<div style="position : relative; left: 40px; float: left;">
    <h1><?php echo "{$user['firstname']} {$user['lastname']}"; ?></h1>
    <?php
    if ($profile['gender'])
    {
	    $this->table->add_row('Gender', $profile['gender']);
    }
    if ($profile['date_of_birth'])
    {
	    $this->table->add_row('Birth Date', $profile['date_of_birth']);
    }
    if ($profile['phone'])
    {
	    $this->table->add_row('Phone', $profile['phone']);
    }
    if ($profile['phone_ext'])
    {
	    $this->table->add_row('Phone Ext', $profile['phone_ext']);
    }
    if ($profile['address_street_1'])
    {
	    $this->table->add_row('Street 1', $profile['address_street_1']);
    }
    if ($profile['address_street_2'])
    {
	    $this->table->add_row('Street 2', $profile['address_street_2']);
    }
    if ($profile['address_city'])
    {
	    $this->table->add_row('City', $profile['address_city']);
    }
    if ($profile['address_state'])
    {
	    $this->table->add_row('State', $profile['address_state']);
    }
    if ($profile['address_zip'])
    {
	    $this->table->add_row('Zip', $profile['address_zip']);
    }
    if ($profile['about'])
    {
	    $this->table->add_row('About', $profile['about']);
    }
    

    $table = $this->table->generate();
    if ($table != "Undefined table data")
    {
	    echo $table;
    }
    else
    {
	    echo "<p>You have not set any profile information!</p>";
    }
    ?>
</div>
