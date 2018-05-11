<?php

////	Use a Password for an existing Member
function Puff_Member_Password_Use($Connection, $Username, $Password) {
	global $Sitewide, $Time;

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Connection, $Username, true);
	if ( !$MemberExists ) {
		return array('error' => 'Sorry, we can\'t change the password for a member that doesn\'t exist.');
	}

	////	Get the latest password information for that member.
	$Hashed = Puff_Member_Password_Get($Connection, $Username);
	////	Verify the entered password against the retrieved hash.
	$Verify = Puff_Member_Password_Verify($Password, $Hashed['Hash'], $Hashed['Salt'], $Hashed['Method']);

	////	TODO Autoupgrade

	return $Verify;
}
