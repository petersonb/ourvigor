<?php
function date_std_mysql($std)
{
	if (preg_match("/\d\d[\/]\d\d[\/]\d\d\d\d/", $std))
	{
		$orig = DateTime::createFromFormat('m/d/Y',$std);
		$out = $orig->format('Y-m-d');
		echo 'here';
	}
	else
	{
		$out = null;
	}
	return $out;
}

function date_mysql_std($mysql)
{
	if (preg_match("/\d\d\d\d[-]\d\d[-]\d\d/",$mysql))
	{
		echo $mysql;
		$orig = DateTime::createFromFormat('Y-m-d',$mysql);
		$out = $orig->format('m/d/Y');
		echo $out;
		echo 'there';
	}
	else
	{
		$out = null;
	}
	
	return $out;
}

function date_twelve_to_24($time)
{
	return DATE("H:i:00", STRTOTIME($time));
}

function date_24_to_twelve($time)
{
	return DATE("g:i a", STRTOTIME($time));
}
