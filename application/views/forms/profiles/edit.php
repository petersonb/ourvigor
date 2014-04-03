<?php
$gender_val = $profile['gender'];
$dob_val = $profile['date_of_birth'];
$phone_val = $profile['phone'];
$phone_ext_val = $profile['phone_ext'];
$street1_val = $profile['address_street_1'];
$street2_val = $profile['address_street_2'];
$city_val = $profile['address_city'];
$state_val = $profile['address_state'];
$zip_val = $profile['address_zip'];
$about_val = $profile['about'];
?>

<?php echo validation_errors(); ?>
<?php echo form_open('profiles/edit'); ?>
<?php

$this->table->add_row('Gender', form_input('gender', $gender_val));

$birthday_params = array (
	'name'  => 'date_of_birth',
	'id'    => 'datepicker',
	'value' => $dob_val
);

$this->table->add_row('Birth Date', form_input($birthday_params));
$this->table->add_row('Phone', form_input('phone', $phone_val));
$this->table->add_row('Phone (EXT)', form_input('phone_ext', $phone_ext_val));
$this->table->add_row('Street 1', form_input('street_1', $street1_val));
$this->table->add_row('Street 2', form_input('street_2', $street2_val));
$this->table->add_row('City', form_input('city', $city_val));
$this->table->add_row('State', form_input('state', $state_val));
$this->table->add_row('Zip', form_input('zip', $zip_val));
$this->table->add_row('About', form_input('about', $about_val));
$this->table->add_row(form_submit('submit', 'Save Changes'),'');
echo $this->table->generate();
?>
</form>
