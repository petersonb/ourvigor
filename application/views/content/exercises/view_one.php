<h1><?php echo $exercise['name']; ?></h1>
<?php if ($exercise['description']): ?>
    <p><?php echo $exercise['description']; ?></p>
<?php endif; ?>

<a href="<?php echo base_url("exercises/modify/{$exercise['id']}"); ?>">Modify This Exercise</a>
<a href="<?php echo base_url("exerciselogs/log/{$exercise['id']}"); ?>">Log an Exercise</a>

<?php $this->load->view('content/exerciselogs/logtable', $exercise); ?>

