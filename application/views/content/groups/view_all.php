<h1>View All Groups</h1>
<?php

if (isset ($groups))
{
	foreach ($groups as $group)
	{
		$url = base_url("groups/view/{$group['id']}");
		$this->table->add_row("<a href=\"{$url}\">" . $group['name']. "</a>");
	}
	echo $this->table->generate();
}
else
{
	echo "<h3>You don't belong to any groups!</h3>";
}