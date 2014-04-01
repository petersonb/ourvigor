<?php

function time_seconds($hours, $minutes, $seconds)
{
	$hour_seconds = time_hours_to_seconds($hours);
	$minute_seconds = time_minutes_to_seconds($minutes);
	return $hour_seconds + $minute_seconds + $seconds;	
}

function time_seconds_to_hours($seconds)
{
	return $seconds / 3600.0;
}

function time_seconds_to_minutes($seconds)
{
	return $seconds / 60.0;
}

function time_seconds_to_string($seconds)
{
	$time = $seconds;
	
	$hours = (int) time_seconds_to_hours($time);
	$time = $time - time_hours_to_seconds($hours);
	
	$minutes = (int) time_seconds_to_minutes($time);
	$time = $time - time_minutes_to_seconds($minutes);
	
	$seconds = $time;

	if ($minutes < 10)
	{
		$minutes = "0{$minutes}";
	}
	if ($seconds < 10)
	{
		$seconds = "0{$seconds}";
	}
	
	$string =  "{$hours}:{$minutes}:{$seconds}";
	return $string;
}

function time_seconds_to_units($seconds)
{
	$time = time_seconds_to_string($seconds);

	$split = explode(':',$time);

	$hours   = $split[0];
	$minutes = $split[1];
	$seconds = $split[2];
	
	$units = array (
		'hours'   => $hours,
		'minutes' => $minutes,
		'seconds' => $seconds
	);

	return $units;
}

function time_hours_to_seconds($hours)
{
	$minutes = time_hours_to_minutes($hours);
	return time_minutes_to_seconds($minutes);
}

function time_hours_to_minutes($hours)
{
	return $hours * 60;
}

function time_minutes_to_seconds($minutes)
{
	return $minutes*60;
}
