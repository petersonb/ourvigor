<h1>Modify <?php echo $exercise['name']; ?> from <?php echo $log['date']; ?></h1>
<p>Hi</p>
<?php $this->load->view('forms/exerciselogs/modify'); ?>
<a href="<?php echo base_url("exerciselogs/delete/{$log['id']}"); ?>">Delete Log</a>
