<h1>Welcome to OurVigor!</h1>
<p>This website is under heavy development. However, still feel free to make an account! You can also check out our <a href="<?php echo base_url('development'); ?>">development page</a>, where you can submit your own ideas for what you would like to see from a fitness social networking web application. You can also read my development logs to see what I've been up to.</p>
<div>
    <h3>Login</h3>
    <?php $this->load->view('forms/users/login'); ?>
</div>
<hr />
<div>
    <p>Don't have an account?</p>
    <h3>Register</h3>
    <p><a href="<?php echo $this->facebook->getLoginUrl(); ?>">Register With Facebook</a></p>
    <p>OurVigor requires a valid email address used for logging in.</p>
    <p>Don't have a Facebook account? <a href="<?php echo base_url('users/register');2 ?>"> Click Here</a></p>
</div>

