<?php

function Puff_Member_Session_Disable($Session, $Connection) {

	$Session = htmlentities($Session, ENT_QUOTES, 'UTF-8');
	$SessionExists = Puff_Member_Session_Exists($Session, $Connection);
	if ( !$SessionExists ) {
		return array('warning' => 'Sorry, that sessions does not exist. I guess that means it\'s sort of disabled already?');
	}

	////	Disable the Session
	$Result = mysqli_query($Connection, 'UPDATE `Sessions` SET `Active`=\'0\' WHERE `Session`=\''.$Session.'\';');
	return $Result;

}
