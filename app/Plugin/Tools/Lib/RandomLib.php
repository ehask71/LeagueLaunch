<?php

/**
 * Random Lib
 *
 * @author Mark Scherer
 * @license MIT
 */
class RandomLib {

	/**
	 * @param integer $min
	 * @param integer $max
	 * @return random int value
	 */
	public static function int($min = 0, $max = 999) {
		return mt_rand($min, $max);
	}

	/**
	 * @param float $min
	 * @param float $max
	 * @return random float value
	 */
	public static function float($min = 0.0, $max = 999.0) {
		$rand = rand(1, 358);
		return $rand * cos($rand);
	}

	/**
	 * Randomly return one of the values provided
	 * careful: only works with numerical keys (0 based!)
	 *
	 * @return mixed
	 */
	public static function arrayValue($array, $minPosition = null, $maxPosition = null, $integerKeys = false) {
		if (empty($array)) {
			return null;
		}
		if ($integerKeys) {
			$max = count($array) - 1;
			return $array[self::int(0, $max)];
		}
		$keys = array_keys($array);
		$values = array_values($array);
		$max = count($keys) - 1;
		return $values[self::int(0, $max)];
	}

	public static function arrayValues($array, $minAmount = null, $maxAmount = null) {
		//NOT IMPORTANT
	}

	//TODO
	/**
	 * 1950-01-01 - 2050-12-31
	 */
	public static function date($min = null, $max = null, $formatReturn = null) {
		if ($min === null && $max === null)
		$res = time();
	elseif ($min > 0 && $max === null)
		$res = $min;
	elseif ($min > 0 && $max > 0)
		$res = self::int($min, $max);
	else
		$res = time();

		$res = 0;
		$formatReturnAs = FORMAT_DB_DATETIME;
		if ($formatReturn !== null) {
			if ($formatReturn === false) {
				return $res;
			}
			$formatReturnAs = $formatReturn;
		}
		return date($formatReturnAs);
	}

	//TODO
	/**
	 * 00:00:00 - 23:59:59
	 */
	public static function time($min = null, $max = null, $formatReturn = null) {

		$res = 0;
		//$returnValueAs = FORMAT_DB_TIME;
		if ($formatReturn !== null) {
			if ($formatReturn === false) {
				return $res;
			}
		}
	}

	/**
	 * Returns a date of birth within the specified age range
	 *
	 * @param (int) $min minimum age in years
	 * @param (int) $max maximum age in years
	 * @return (string) $dob a db (ISO) format datetime string
	 */
	public static function dob($min = 18, $max = 100) {
		$dobYear = date('Y') - (self::int($min, $max));

		$dobMonth = self::int(1, 12);

		if ($dobMonth == 2) {
			// leap year?
			if ($ageYears % 4 || $ageYears % 400)
				$maxDays = 29;
			else
				$maxDays = 28;
		} elseif (in_array($dobMonth, array(4, 6, 9, 11)))
			$maxDays = 30;
		else
			$maxDays = 31;

		$dobDay = self::int(1, $maxDays);

		$dob = sprintf("%4d-%02d-%02d", $dobYear, $dobMonth, $dobDay);
		return $dob;
	}

	/**
	 * Generates a password
	 *
	 * @param integer $length Password length
	 * @return string
	 * @link https://github.com/CakeDC/users/blob/master/models/user.php#L498
	 */
	public static function pronounceablePwd($length = 10) {
		srand((double)microtime() * 1000000);
		$password = '';
		$vowels = array("a", "e", "i", "o", "u");
		$cons = array("b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr",
							"cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl");
		for ($i = 0; $i < $length; $i++) {
			$password .= $cons[mt_rand(0, 31)] . $vowels[mt_rand(0, 4)];
		}
		return substr($password, 0, $length);
	}

	/**
	 * @deprecated!
	 */
	public static function pwd($type = null, $length = null) {
		return self::randomPwd($type, $length);
	}

	/**
	 * Returns auto-generated password
	 *
	 * @param string $type: user, ...
	 * @param integer $length (if no type is submitted)
	 * @return pwd on success, empty string otherwise
	 */
	public static function randomPwd($type = null, $length = null) {
		if (!empty($type) && $type === 'user') {
			return self::generatePassword(6);
		}
		if (!empty($length)) {
			return self::generatePassword($length);
		}
		return '';
	}

	/**
	 * //TODO: move to password lib?
	 * Generate random passwords
	 *
	 * @param integer $lenght (necessary!)
	 * @return string Password
	 */
	public static function generatePassword($length, $chars = null) {
		if ($chars === null) {
			$chars = '234567890abcdefghijkmnopqrstuvwxyz'; // ABCDEFGHIJKLMNOPQRSTUVWXYZ
		}
		$i = 0;
		$password = '';
		$max = strlen($chars) - 1;

		while ($i < $length) {
			$password .= $chars[mt_rand(0, $max)];
			$i++;
		}
		return $password;
	}

	/**
	 * Few years ago i had written Joomla component AutoContent. That component generates new unique content and add it to Joomla site. In general, this is not good tool, because it does black SEO things. If search engine (ex. Google) finds that there is autogenerated text without sense then site can be banned
	 * @link http://www.gelembjuk.com/index.php?option=com_content&view=article&id=60&catid=37:php&Itemid=56
	 */
	public static function sentences($sentences, $wordscount = 2) {
		$hash = array();
		$resultsentences = array();

		for ($i = 0; $i < count($sentences); $i++) {
			$words = split(' ', trim($sentences[$i]));

			for ($k = 0; $k < count($words) - $wordscount; $k++) {
				$prefix = trim(join(' ', array_slice($words, $k, $wordscount)));
				if ($prefix === '')
					continue;

				if (empty($hash[$prefix])) {
					$hash[$prefix] = array($words[$k + $wordscount]);

					for ($j = $i + 1; $j < count($sentences); $j++) {
						if (preg_match('/' . ereg_replace('/', '\/', preg_quote($prefix)) . '(.*)$/', $sentences[$j], $m)) {
							$w = split(' ', trim($m[1]));

							if (count($w) > 0 && trim($w[0]) !== '')
								array_push($hash[$prefix], trim($w[0]));
						}
					}
				}
			}
		}

		$prefixes = array_keys($hash);

		$stpr = array();
		foreach ($prefixes as $pr) {
			if ($pr[0] == strtoupper($pr[0]))
				array_push($stpr, $pr);
		}

		for ($i = 0; $i < count($sentences); $i++) {
			$p = $stpr[rand(0, count($stpr) - 1)];
			$sent = split(' ', $p);
			$cc = count(split(' ', $sentences[$i]));

			$j = 0;

			do {
				$w = $hash[$p][rand(0, count($hash[$p]) - 1)];
				array_push($sent, $w);
				$j++;

				$p = join(' ', array_slice($sent, $j, $wordscount));
			} while (strrpos($w, '.') != strlen($w) - 1 && $j < $cc * 2);

			$sn = join(' ', $sent);
			if ($sn[strlen($sn) - 1] !== '.')
				$sn .= '.';
			array_push($resultsentences, $sn);
		}
		return $resultsentences;
	}

	/**
	 * Other implemantations
	 */

	/**
	 * Generates a random string of a given type and length.
	 * $str = Text::random(); // 8 character random string
	 *
	 * The following types are supported:
	 *
	 * alnum
	 * : Upper and lower case a-z, 0-9
	 *
	 * alpha
	 * : Upper and lower case a-z
	 *
	 * hexdec
	 * : Hexadecimal characters a-f, 0-9
	 *
	 * distinct
	 * : Uppercase characters and numbers that cannot be confused
	 *
	 * You can also create a custom type by providing the "pool" of characters
	 * as the type.
	 *
	 * @param string a type of pool, or a string of characters to use as the pool
	 * @param integer length of string to return
	 * @return string
	 */
	public static function random($type = 'alnum', $length = 8) {
		switch ($type) {
			case 'alnum':
				$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'alpha':
				$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				break;
			case 'hexdec':
				$pool = '0123456789abcdef';
				break;
			case 'numeric':
				$pool = '0123456789';
				break;
			case 'nozero':
				$pool = '123456789';
				break;
			case 'distinct':
				$pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
				break;
			default:
				$pool = (string )$type;
				//$utf8 = ! UTF8::is_ascii($pool);
				break;
		}

		// Split the pool into an array of characters
		$pool = ($utf8 === true) ? str_split($pool, 1) : str_split($pool, 1);

		// Largest pool key
		$max = count($pool) - 1;

		$str = '';
		for ($i = 0; $i < $length; $i++) {
			// Select a random character from the pool and add it to the string
			$str .= $pool[mt_rand(0, $max)];
		}

		// Make sure alnum strings contain at least one letter and one digit
		if ($type === 'alnum' && $length > 1) {
			if (ctype_alpha($str)) {
				// Add a random digit
				$str[mt_rand(0, $length - 1)] = chr(mt_rand(48, 57));
			} elseif (ctype_digit($str)) {
				// Add a random letter
				$str[mt_rand(0, $length - 1)] = chr(mt_rand(65, 90));
			}
		}

		return $str;
	}

}
