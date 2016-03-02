<?php

function Puff_Member_Create($Connection, $Username, $Password) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Connection, $Username);
	if ( $MemberExists ) {
		// TODO Try to log-in instead.
		return array('error' => 'Sorry, that username is not available. Please choose a different username, or login if this is your username.');
	}

	////	Generate a Salt
	// The salt will be a 128 character hexidecimal hash from a secure source.
	// Will return an error if no secure source is available.
	$Salt = Puff_SecureRandom();
	if ( !$Salt ) {
		return array('error' => 'Error: No secure source was available for Salt generation. Your password could not be secured. This is not your fault.');
	}

	////	Hash Password
	$Hashed = Puff_Member_PassHash($Password, $Salt);

	////	Insert into Database
	$Result = mysqli_query($Connection, 'INSERT INTO `Members` (`Username`, `Password`, `Salt`, `PassHash`) VALUES (\''.$Username.'\', \''.$Hashed['Password'].'\', \''.$Salt.'\', \''.$Hashed['PassHash'].'\');');
	return $Result;

}
