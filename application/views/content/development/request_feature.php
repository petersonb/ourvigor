<?php if (!$success): ?>
<h1>OurVigor New Feature Request</h1>
<?php $this->load->view('forms/development/request_feature'); ?>
<?php else: ?>
<h1>Thank You!</h1>
<p>Thank you for your submission. I will take your idea into consideration, and if I like it, I will be sure to credit your name!</p>
<?php endif; ?>
