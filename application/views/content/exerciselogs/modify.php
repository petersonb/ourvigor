<h1>Modify <?php echo $exercise['name']; ?> from <?php echo $log['date']; ?></h1>
<?php $this->load->view('forms/exerciselogs/modify'); ?>
<a href="<?php echo base_url("exerciselogs/delete/{$log['id']}"); ?>">Delete Log</a>
