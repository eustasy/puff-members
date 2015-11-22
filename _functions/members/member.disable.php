<?php

function Puff_Member_Disable($Connection, $Username) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Connection, $Username, true);
	if ( !$MemberExists ) {
		return array('warning' => 'Sorry, that user does not exist. I guess that means it\'s sort of disabled already?');
	}

	////	Disable existing Sessions
	Puff_Member_Session_Disable_All($Connection, $Username);

	////	Disable the User
	$Result = mysqli_query($Connection, 'UPDATE `Members` SET `Active`=\'0\' WHERE `Username`=\''.$Username.'\';');
	return $Result;

}
