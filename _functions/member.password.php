<?php

function Puff_Member_Password($Username, $Password, $Connection, $CurrentSession) {

	$Member['Username'] = $Username;
	$Member['Password'] = $Password;
	$Member['PassHash'] = 'sha512';

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Member['Username'] = Puff_Member_Sanitize_Username($Member['Username']);
	$MemberExists = Puff_Member_Exists($Member['Username'], $Connection, true);
	if ( $MemberExists ) {
		return array('error' => 'Sorry, we can\'t change the password for a member that doesn\'t exist.');
	}

	////	Re-Generate a Salt
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

	////	Disable existing Sessions
	Puff_Member_Session_Disable_All($Username, $Connection, $CurrentSession);

	////	Update Database
	$Result = mysqli_query($Connection, 'UPDATE `Members` SET `Password`=\''.$Member['Password'].'\', `Salt`=\''.$Member['Salt'].'\', `PassHash`=\''.$Member['PassHash'].'\' WHERE `Username`=\''.$Member['Username'].'\';');
	return $Result;

}
