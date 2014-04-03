<?php
function date_std_mysql($std)
{
	$orig = DateTime::createFromFormat('m/d/Y',$std);
	echo $orig->format('Y-d-m');
	return $orig->format('Y-m-d');
}

function date_mysql_std($mysql)
{
	$orig = DateTime::createFromFormat('Y-m-d',$mysql);
	return $orig->format('m/d/Y');
}

function date_twelve_to_24($time)
{
	return DATE("H:i:00", STRTOTIME($time));
}

function date_24_to_twelve($time)
{
	return DATE("g:i a", STRTOTIME($time));
}
