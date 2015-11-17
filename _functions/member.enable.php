<?php

function Puff_Member_Enable($Username, $Connection) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Username, $Connection);
	if ( !$MemberExists ) {
		return array('warning' => 'Sorry, that user does not exist.');
	}

	////	Disable existing Sessions
	Puff_Member_Session_Disable_All($Username, $Connection);

	////	Enable the User
	$Result = mysqli_query($Connection, 'UPDATE `Members` SET `Active`=\'1\' WHERE `Username`=\''.$Username.'\';');
	return $Result;

}
