<?php
function date_std_mysql($std)
{
	try
	{
		$orig = DateTime::createFromFormat('m/d/Y',$std);
		echo $orig->format('Y-d-m');
		$out = $orig->format('Y-m-d');
	}
	catch (Exception $e)
	{
		$out = null;
	}
	return $out;
}

function date_mysql_std($mysql)
{
	try {
		$orig = DateTime::createFromFormat('Y-m-d',$mysql);
		$out = $orig->format('m/d/Y');
	} catch (Exception $e)
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
