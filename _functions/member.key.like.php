<?php

function Puff_Member_Key_Like($Username, $Key, $Connection) {
	$Username = Puff_Member_Sanitize_Username($Username);
	$Key = htmlentities($Key, ENT_QUOTES, 'UTF-8');
	$Result = mysqli_qeury($Connection, 'SELECT * FROM `KeyValues` WHERE `Username`=\''.$Username.'\' AND `Key` LIKE \'%'.$Key.'%\';');
	return $Result;
}
