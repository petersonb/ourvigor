<img class="profilePictureViewProfile" src="<?php echo base_url("uploads/profile_pictures/profile_pic_{$user['id']}.png"); ?>" />

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
