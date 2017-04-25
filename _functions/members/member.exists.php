<?php

function Puff_Member_Exists($Connection, $Username, $Active = false) {
	$SQL = 'SELECT * FROM `Members` WHERE `Username`=\''.$Username.'\'';
	if ( $Active ) {
		$SQL .= ' AND `Active`=\'1\'';
	}
	$SQL .= ';';
	$MemberExists = mysqli_fetch_count($Connection, $SQL);
	return $MemberExists;
}
