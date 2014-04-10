<h1><?php echo $exercise['name']; ?></h1>
<?php if ($exercise['description']): ?>
    <p><?php echo $exercise['description']; ?></p>
<?php endif; ?>

<a href="<?php echo base_url("exerciselogs/log/{$exercise['id']}"); ?>">Log this Exercise</a> |
<a href="<?php echo base_url("exercises/modify/{$exercise['id']}"); ?>">Modify This Exercise</a>

<hr />
<?php $this->load->view('content/exerciselogs/logtable', $exercise); ?>

<?php if ($exercise['fields']['dist']): ?>
<hr />
<div id="distChart"></div>
<?php endif; ?>
<?php if ($exercise['fields']['dist']): ?>
<hr />
<div id="timeChart"></div>
<?php endif; ?>
<?php if ($exercise['fields']['dist']): ?>
<hr />
<div id="distTimeChart"></div>
<?php endif; ?>
<input id="exercise_id" type="hidden" value="<?php echo $exercise['id']; ?>" />
