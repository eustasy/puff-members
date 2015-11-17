<?php

function Puff_Member_Session_Disable_All($Username, $Connection) {

	$Username = Puff_Member_Sanitize_Username($Username);
	$Result = mysqli_query($Connection, 'UPDATE `Sessions` SET `Active`=\'0\' WHERE `Username`=\''.$Username.'\';');
	return $Result;

}
