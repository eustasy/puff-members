<?php

function Puff_Member_Exists($Username, $Connection) {
	$MemberExists = mysqli_fetch_count($Connection, 'SELECT * FROM `Members` WHERE `Username`=\''.$Username.'\';');
	return $MemberExists;
}
