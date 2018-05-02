<?php

function Puff_Member_Session_Exists($Connection, $Session, $Active = true, $IPCheck = false) {

	$SQL = 'SELECT * FROM `Sessions` WHERE `Session`=\''.$Session.'\'';

	if ( $Active ) {
		$SQL .= ' AND `Active`=\'1\'';
	}

	////	Figure out IP
	$CurrentIP = Puff_Member_Session_IP();

	if ( $IPCheck && $CurrentIP ) {
		// TODO This half check is rather arbitrary.
		$IPPart = str_split($CurrentIP, round(strlen($CurrentIP)/2))[0];
		$SQL .= ' AND `IP` LIKE \''.$IPPart.'%\'';
	}

	$SQL .= ';';
	$SessionExists = mysqli_fetch_count($Connection, $SQL);
	return $SessionExists;

}
