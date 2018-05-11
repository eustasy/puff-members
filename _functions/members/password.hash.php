<?php

////	Hash a Password
function Puff_Member_Password_Hash($Password, $Salt = false, $Method = false) {
	global $Sitewide;

	////	BCRYPT
	if (
		$Sitewide['Settings']['Members']['Password Retention']['BCRYPT'] &&
		(
			$Method = 'BCRYPT' ||
			!$Method
		)
	) {
		return array('Password' => $Password, 'Salt' => '', 'Method' => 'BCRYPT');

	////	Sha512
	// Hash the password,
	// then hash the result and the salt
	// (which is already a hexadecimal)
	} elseif (
		$Method = 'sha512' ||
		!$Method
	) {
		$Method = 'sha512';
		if ( !$Salt ) {
			$Salt = Puff_SecureRandom();
			if ( !$Salt ) {
				$Msg = 'Error: No secure source was available for Salt generation.';
				$Msg .= ' Your password could not be secured. This is not your fault.';
				return array('error' => $Msg);
			}
		}
		$Password = hash($Method, $Password);
		$Password = hash($Method, $Password . $Salt);
		return array('Password' => $Password, 'Salt' => $Salt, 'Method' => $Method);

	////	PLAIN
	} elseif (
		$Sitewide['Settings']['Members']['Password Retention']['PLAIN'] &&
		$Method = 'PLAIN'
	) {
		return array('Password' => $Password, 'Salt' => '', 'Method' => 'PLAIN');
	}
}
