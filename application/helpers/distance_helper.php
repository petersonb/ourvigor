<?php


//////////////////////////////////////////////////
// Metric to Standard                           //
//////////////////////////////////////////////////

function distance_meters_to_feet($meters)
{
	return $meters * 3.28084;
}

function distance_meters_to_miles($meters)
{
	$feet = distance_meters_to_feet($meters);
	return $feet * 5280.0;
}

//////////////////////////////////////////////////
// Standard to Metric                           //
//////////////////////////////////////////////////

function distance_feet_to_meters($feet)
{
	return $feet * (1/3.28084);
}

function distance_miles_to_meters($miles)
{
	$feet = $miles*5280.0;
	return distance_feet_to_meters($feet);
}
