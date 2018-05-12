<?php

namespace Classes\Helpers;

// class that contains some helper functions
class Functions
{
	public static function validDateTime(string $datetime, string $format)
	{
		return \DateTime::createFromFormat($format, $datetime);
	}

	public static function validInteger($input)
	{
		return preg_match('/^([0-9]*)$/', $input);
	}
}