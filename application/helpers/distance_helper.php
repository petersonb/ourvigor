<?php

function distance_exit($value, $precision = 4)
{
	$rounded_value = round($value, $precision);
	$out = $rounded_value;
	return $out;
}

//////////////////////////////////////////////////
// Metric to Standard                           //
//////////////////////////////////////////////////

function distance_meters_to_feet($meters)
{
	$out = distance_exit($meters * 3.28084);
	return $out;
}

function distance_meters_to_miles($meters)
{
	$feet = distance_meters_to_feet($meters);
	$miles = distance_feet_to_miles($feet);
	$out = distance_exit($miles);
	return $out;
}

//////////////////////////////////////////////////
// Standard to Metric                           //
//////////////////////////////////////////////////

function distance_feet_to_meters($feet)
{
	$value = distance_exit($feet * (1/3.28084));
	return $value;
}

function distance_miles_to_meters($miles)
{
	$feet = $miles*5280.0;
	$meters = distance_feet_to_meters($feet);
	$out = distance_exit($meters);
	return $out;
}


//////////////////////////////////////////////////
// Standard                                     //
//////////////////////////////////////////////////

function distance_feet_to_miles($feet)
{
	return distance_exit($feet / 5280.0);
}
