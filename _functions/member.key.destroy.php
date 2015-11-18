<?php

function Puff_Member_Key_Destroy($Username, $Key, $Connection) {

	$Username = Puff_Member_Sanitize_Username($Username);
	$Key      = htmlentities($Key, ENT_QUOTES, 'UTF-8');

	$OldValue = Puff_Member_Key_Value($Username, $Key, $Connection);
	if ( !$OldValue ) {
		return array('error' => 'Sorry, that UserKeyValue combination doesn\'t exist.');
	}

	////	Destroy the User
	$Result = mysqli_query($Connection, 'DELETE FROM `KeyValues` WHERE `Username`=\''.$Username.'\' AND `Key`=\''.$Key.'\';');
	return $Result;

}
