<?php

////	Set a new Password for an existing Member
function Puff_Member_Password_Set($Connection, $Username, $Password, $CurrentSession = false) {
	global $Sitewide, $Time;

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Connection, $Username, true);
	if ( !$MemberExists ) {
		return array('error' => 'Sorry, we can\'t change the password for a member that doesn\'t exist.');
	}

	////	Hash Password
	$Hashed = Puff_Member_Password_Hash($Password);

	////	Disable existing Sessions
	Puff_Member_Session_Disable_All($Connection, $Username, $CurrentSession);

	////	Insert new password into Database
	$New = 'INSERT INTO `Passwords` (`Username`, `Method`, `Hash`, `Salt`, `Created`) VALUES ';
	$New .= '(\''.$Username.'\', \''.$Hashed['Password'].'\', \''.$Hashed['Salt'].'\', ';
	$New .= '\''.$Hashed['Method'].'\', \''.$Time.'\');';
	$New = mysqli_query($Connection, $New);

	////	Clean up older passwords
	$CleanUp = 'DELETE FROM `Passwords` WHERE ';
	// TOO OLD
	$CleanUp .= '( `Username` = \''.$Username.'\' AND ';
	$CleanUp .= '`Created` <= '.( $Time - $Sitewide['Settings']['Members']['Password Retention']['Oldest'] ).') OR ';
	// PLAIN
	$CleanUp .= '`Method` = \'PLAIN\';';
	$CleanUp = mysqli_query($Connection, $CleanUp);

	$Result = array(
		'New' => $New,
		'CleanUp' => $CleanUp,
	);
	return $Result;
}
