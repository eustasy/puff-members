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

	////	Hash Password
	$Hashed = Puff_Member_PassHash($Password);

	////	Disable existing Sessions
	Puff_Member_Session_Disable_All($Connection, $Username, $CurrentSession);

	////	Update Database
	$Result = mysqli_query($Connection, 'UPDATE `Members` SET `Password`=\''.$Hashed['Password'].'\', `Salt`=\''.$Salt.'\', `PassHash`=\''.$Hashed['PassHash'].'\' WHERE `Username`=\''.$Username.'\';');
	return $Result;

}
