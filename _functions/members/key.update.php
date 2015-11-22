<?php

function Puff_Member_Key_Update($Connection, $Username, $Key, $Value) {

	$Username = Puff_Member_Sanitize_Username($Username);
	$Key      = htmlentities($Key, ENT_QUOTES, 'UTF-8');
	$Value    = htmlentities($Value, ENT_QUOTES, 'UTF-8');

	$OldValue = Puff_Member_Key_Value($Connection, $Username, $Key);
	if ( !$OldValue ) {
		return array('error' => 'Sorry, that UserKeyValue combination doesn\'t exist.');
	}

	$Result = mysqli_query($Connection, 'UPDATE `KeyValues` SET `Value`=\''.$Value.'\' WHERE `Username`=\''.$Username.'\' AND `Key`=\''.$Key.'\';');
	return $Result;

}