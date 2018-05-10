<?php

function Puff_Member_Create($Connection, $Username, $Password) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Connection, $Username);
	if ( $MemberExists ) {
		$Msg = 'Sorry, that username is not available.';
		$Msg .= ' Please choose a different username, or login if this is your username.';
		return array('error' => $Msg);
	}

	////	Hash Password
	$Hashed = Puff_Member_PassHash($Password);

	////	Insert into Database
	$Result['Member'] = mysqli_query($Connection, 'INSERT INTO `Members` (`Username`) VALUES (\''.$Username.'\');');
	$Result['Password'] = Puff_Member_Password(
		$Connection,
		$Username,
		$Hashed['Method'],
		$Hashed['Hash'],
		$Hashed['Salt']
	);
	return $Result;
}
