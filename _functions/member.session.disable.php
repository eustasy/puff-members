<?php

function Puff_Member_Session_Disable($Session, $Connection) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Session = htmlentities($Session, ENT_QUOTES, 'UTF-8');
	$SessionExists = Puff_Member_Session_Exists($Session, $Connection);
	if ( !$SessionExists ) {
		return array('warning' => 'Sorry, that sessions does not exist. I guess that means it\'s sort of disabled already?');
	}

	////	Disable the User
	$Result = mysqli_query($Connection, 'UPDATE `Sessions` SET `Active`=\'0\' WHERE `Session`=\''.$Session.'\';');
	return $Result;

}
