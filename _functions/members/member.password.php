<?php

function Puff_Member_Password($Connection, $Username, $Password, $CurrentSession = false) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Connection, $Username, true);
	if ( !$MemberExists ) {
		return array('error' => 'Sorry, we can\'t change the password for a member that doesn\'t exist.');
	}

	////	Re-Generate a Salt
	// The salt will be a 128 character hexidecimal hash from a secure source.
	// Will return an error if no secure source is available.
	$Salt = Puff_SecureRandom();
	if ( !$Salt ) {
		return array('error' => 'Error: No secure source was available for Salt generation. Your password could not be secured. This is not your fault.');
	}

	////	Hash Password
	$Hashed = Puff_Member_PassHash($Password, $Salt);

	////	Disable existing Sessions
	Puff_Member_Session_Disable_All($Connection, $Username, $CurrentSession);

	////	Update Database
	$Result = mysqli_query($Connection, 'UPDATE `Members` SET `Password`=\''.$Hashed['Password'].'\', `Salt`=\''.$Salt.'\', `PassHash`=\''.$Hashed['PassHash'].'\' WHERE `Username`=\''.$Username.'\';');
	return $Result;

}
