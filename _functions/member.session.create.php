<?php

function Puff_Member_Session_Create($Username, $Connection) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Username, $Connection, true);
	if ( !$MemberExists ) {
		return array('error' => 'Sorry, that user doesn\'t exist, so we can\'t make a session for it.');
	}

	////	Generate a Session
	// The Session will be a 128 character hexidecimal hash from a secure source.
	// Will return an error if no secure source is available.
	if ( function_exists('mcrypt_create_iv') ) {
		$Session = mcrypt_create_iv(64);
		$Strong = true;
	} else if ( function_exists('openssl_random_pseudo_bytes') ) {
		// Don't set strong here because the function does it based on the source.
		$Session = openssl_random_pseudo_bytes(64, $Strong);
	} else {
		$Strong = false;
	}
	if ( !$Strong ) {
		return array('error' => 'Error: No secure source was available for Session generation. Your password could not be secured. This is not your fault.');
	}
	$Session = bin2hex($Session);

	// Collision Chance:
	// 16 base
	// 128 characters
	// 16^128 = 1.34*10^124

	////	Insert into Database
	$Result = mysqli_query($Connection, 'INSERT INTO `Sessions` (`Username`, `Session`) VALUES (\''.$Username.'\', \''.$Session.'\');');
	return $Result;

}
