<?php

function Puff_Member_Destroy($Username, $Connection) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Username, $Connection);
	if ( !$MemberExists ) {
		return array('warning' => 'Sorry, that user does not exist. I guess that means it\'s sort of gone already?');
	}

	////	Disable existing Sessions
	Puff_Member_Session_Disable_All($Username, $Connection);

	////	Destroy the User
	$Result = mysqli_query($Connection, 'DELETE FROM `Members` WHERE `Username`=\''.$Username.'\';');
	return $Result;

}
