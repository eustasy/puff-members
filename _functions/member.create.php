<?php

function Puff_Member_Create($Username, $Password, $Connection) {

	$Member['Username'] = $Username;
	$Member['Password'] = $Password;
	$Member['PassHash'] = 'sha512';

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Member['Username'] = Puff_Member_Sanitize_Username($Member['Username']);
	$MemberExists = Puff_Member_Exists($Member['Username'], $Connection);
	if ( $MemberExists ) {
		// TODO Try to log-in instead.
		return array('error' => 'Sorry, that username is not available. Please choose a different username, or login if this is your username.');
	}

	////	Generate a Salt
	// The salt will be a 128 character hexidecimal hash from a secure source.
	// Will return an error if no secure source is available.
	if ( function_exists('mcrypt_create_iv') ) {
		$Member['Salt'] = mcrypt_create_iv(64);
		$Strong = true;
	} else if ( function_exists('openssl_random_pseudo_bytes') ) {
		// Don't set strong here because the function does it based on the source.
		$Member['Salt'] = openssl_random_pseudo_bytes(64, $Strong);
	} else {
		$Strong = false;
	}
	if ( !$Strong ) {
		return array('error' => 'Error: No secure source was available for Salt generation. Your password could not be secured. This is not your fault.');
	}
	$Member['Salt'] = bin2hex($Member['Salt']);

	////	Hash Password
	// Hash the password,
	// then hash the result and the salt
	// (which is already a hexadecimal)
	$Member['Password'] = hash($Member['PassHash'], $Member['Password']);
	$Member['Password'] = hash($Member['PassHash'], $Member['Password'] . $Member['Salt']);

	$Result = mysqli_query($Connection, 'INSERT INTO `Members` (`Username`, `Password`, `Salt`, `PassHash`) VALUES (\''.$Member['Username'].'\', \''.$Member['Password'].'\', \''.$Member['Salt'].'\', \''.$Member['PassHash'].'\');');
	return $Result;

}
