<?php

function Puff_Member_Session_Exists($Connection, $Session, $Active = true) {
	$SQL = 'SELECT * FROM `Sessions` WHERE `Session`=\''.$Session.'\'';
	if ( $Active ) {
		$SQL .= ' AND `Active`=\'1\'';
	}
	$SQL .= ';';
	$SessionExists = mysqli_fetch_count($Connection, $SQL);
	return $SessionExists;
}
