<h1>Delete Log</h1>
<?php if ($success == FALSE): ?>
    <p>This will delete this log forever. Are you sure you wish to do this?</p>
    <?php $this->load->view('forms/exerciselogs/delete'); ?>
<?php else: ?>
    <p>Your log has been deleted.</p>
    <a href="<?php echo base_url('exercises/view'); ?>">Return</a>
<?php endif; ?>
