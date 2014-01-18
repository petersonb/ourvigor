<h1>View Group</h1>
<?php
// TODO This is shitty
$this->table->add_row('Group Name',$group['name']);
$this->table->add_row('',$group['description']);
$this->table->add_row('Visibility',$group['visibility']);
$this->table->add_row('Categories',$group['categories']);
echo $this->table->generate();
