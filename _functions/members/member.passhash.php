<?php

////	Hash a Password
// Hash the password,
// then hash the result and the salt
// (which is already a hexadecimal)
function Puff_Member_PassHash($Password, $Salt = false, $PassHash = 'sha512') {
	if ( !$Salt ) {
		$Salt = Puff_SecureRandom();
		if ( !$Salt ) {
			return array('error' => 'Error: No secure source was available for Salt generation. Your password could not be secured. This is not your fault.');
		}
	}
	$Password = hash($PassHash, $Password);
	$Password = hash($PassHash, $Password . $Salt);
	return array('Password' => $Password, 'Salt' => $Salt, 'PassHash' => $PassHash);
}
