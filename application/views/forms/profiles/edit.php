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
<table>
    <tr>
	<td>Gender</td>
	<td>
	    <select name="gender">
		<option <?php if ($gender_val == 'm'): ?>selected="selected" <?php endif; ?> value="m">Male</option>
		<option <?php if ($gender_val == 'f'): ?>selected="selected" <?php endif; ?> value="f">Female</option>
		<option <?php if ($gender_val != 'm' && $gender_val != 'f'): ?>selected="selected" <?php endif; ?> value="n">Not Specified</option>
	    </select>
	</td>
    </tr>
    <tr>
	<td>Birth Date</td>
	<td><input type="text" id="datepicker" name="date_of_birth" value="<?php echo $dob_val; ?>" /></td>
    </tr>
    <tr>
	<td>Phone</td>
	<td><input type="text" name="phone" value="<?php echo $phone_val; ?>" /></td>
    </tr>
    <tr>
	<td>Phone (EXT)</td>
	<td><input type="text" name="phone_ext" value="<?php echo $phone_ext_val; ?>" /></td>
    </tr>
    <tr>
	<td>Street 1</td>
	<td><input type="text" name="street_1" value="<?php echo $street1_val; ?>" /></td>
    </tr>
    <tr>
	<td>Street 2</td>
	<td><input type="text" name="street_2" value="<?php echo $street2_val; ?>" /></td>
    </tr>
    <tr>
	<td>City</td>
	<td><input type="text" name="city" value="<?php echo $city_val; ?>" /></td>
    </tr>
    <tr>
	<td>State</td>
	<td><input type="text" name="state" value="<?php echo $state_val; ?>" /></td>
    </tr>
    <tr>
	<td>Zip</td>
	<td><input type="text" name="zip" value="<?php echo $zip_val; ?>" /></td>
    </tr>
    <tr>
	<td>About</td>
	<td><textarea><?php echo $about_val; ?></textarea></td>
    </tr>
</table>
<input type="submit" value="Save" />
</form>
