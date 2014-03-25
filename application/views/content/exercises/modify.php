<h1> Modify <?php echo $exercise['name']; ?></h1>
<?php $this->load->view('forms/exercises/modify.php'); ?>
<a href="<?php  echo base_url("exercises/delete/{$exercise['id']}"); ?>">Delete Exercise</a>
