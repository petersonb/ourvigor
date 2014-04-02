<h1>Welcome <?php echo $user['firstname']; ?>!</h1>
<p>Here is the information we received from Facebook. You can change this later if you would like.</p>
<table>
    <tr>
	<td>First Name:</td>
	<td><?php echo $user['firstname']; ?></td>
    </tr>
    <tr>
	<td>Last Name:</td>
	<td><?php echo $user['lastname']; ?></td>
    </tr>
    <tr>
	<td>Email:</td>
	<td><?php echo $user['email']; ?></td>
    </tr>
</table>
<p>All we need now is for you to enter a password for OurVigor. This password is only for your OurVigor account.</p>
<?php $this->load->view('forms/users/facebook_register'); ?>

