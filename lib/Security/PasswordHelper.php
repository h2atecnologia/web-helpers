<?php

namespace Security;

class PasswordHelper
{
	public static function generate_code( $len = 8 )
	{
		$charset = "Aa@2B*b54D#7d9*83%2G\$6gH#h63\$J8j9*LM4mN#5nP7#Q@qRr3*2Ss2T\$t7U%uV@WYyZ\$z\$2#3a45m*665%n76\$7u89%pAa2B*b54D#7d983%52G6gH@h63J8j9L%M4mN5nP7QqR*r32Ss2Tt\$7U%uVWY#yZz@23a4*5m665\$n7#67u8\$9p";
		$code = '';
		
		for($i = 1, $cslen = strlen($charset); $i <= $len; ++$i) {
			$c = $charset{rand(0, $cslen - 1)};
			if($c != $code{strlen($code) - 1})
				$code .= $c;
			else
				--$i;
		}
		return $code;
	}

	public static function validate_code( $new_code, $len = 8, $check_letter = true, $check_one_upper = true, $check_number = true, $check_symbol = true )
	{
		if(empty($new_code) || strlen(trim($new_code)) < $len)
		{
			return false;
		}
		 		
		$code = null;

		$have_letter = false;
		$have_one_upper = false;
		$have_number = false;
		$have_symbol = false;

		for($i = 0; $i < strlen($new_code); $i++)
		{
			if($new_code{$i} != strtolower($code))
				$code = $new_code{$i};
			else
			{
				return false;
			}
			
			if($code >= 'A' && $code <= 'Z')
				$have_one_upper = true;
			if($code >= 'a' && $code <= 'z')
				$have_letter = true;
			if($code >= '0' && $code <= '9')
				$have_number = true;
			if(strpos("\$*()[]{};,-=\&<>\\/!@%#.", $code ) !== false)
				$have_symbol = true;
		}

		if(!$have_one_upper && $check_one_upper)
			return false;

		if(!$have_letter && $check_letter)
			return false;

		if(!$have_number && $check_number)
			return false;

		if(!$have_symbol && $check_symbol)
			return false;
		
		return true;
	}
}

?>