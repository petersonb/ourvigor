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
</div>

<br />
<div style="position : relative; left: 40px; float: left;">
    <h1><?php echo "{$user['firstname']} {$user['lastname']}"; ?></h1>
    <?php
    $this->table->add_row('Gender', $profile['gender']);
    $this->table->add_row('DOB', $profile['date_of_birth']);
    $this->table->add_row('Phone', $profile['phone']);
    $this->table->add_row('Phone Ext', $profile['phone_ext']);
    $this->table->add_row('Street 1', $profile['address_street_1']);
    $this->table->add_row('Street 2', $profile['address_street_2']);
    $this->table->add_row('City', $profile['address_city']);
    $this->table->add_row('State', $profile['address_state']);
    $this->table->add_row('Zip', $profile['address_zip']);
    $this->table->add_row('About', $profile['about']);

    echo $this->table->generate();
    ?>
</div>
