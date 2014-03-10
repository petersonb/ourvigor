<?php

function time_seconds($hours, $minutes, $seconds)
{
	$hour_seconds = time_hours_to_seconds($hours);
	$minute_seconds = time_minutes_to_seconds($minutes);
	return $hour_seconds + $minute_seconds + $seconds;
	
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
