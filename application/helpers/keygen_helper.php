<?php

/*
Generate
--------------------------------------------------

This method generates a unique key that can be
used for any occasion requiring a random key.
--------------------------------------------------
 */
function keygen_generate($length = 32)
{
	$value = '';
	$keys = array_merge(range(0,9),range('a','f'));
	
	
	for ($i = 0; $i < $length; $i++)
	{
		$value .= $keys[array_rand($keys)];
	}

	$check = new Token();
	$check->where('value',$value)->get();

	if ($check->exists())
		$token = $this->generate_token();

	return $value;
}
