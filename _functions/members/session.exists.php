<?php

function Puff_Member_Session_Exists($Connection, $Session, $Active = true, $IPCheck = false) {

	$SQL = 'SELECT * FROM `Sessions` WHERE `Session`=\''.$Session.'\'';

	if ( $Active ) {
		$SQL .= ' AND `Active`=\'1\'';
	}

	////	Figure out IP
	// TODO Absctract
	if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
		$IP = $_SERVER['HTTP_CF_CONNECTING_IP'];
	} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$IP = $_SERVER['HTTP_CLIENT_IP'];
	} else if (!empty($_SERVER['REMOTE_ADDR'])) {
		$IP = $_SERVER['REMOTE_ADDR'];
	} else {
		$IP = false;
	}
	if ( $IPCheck && $IP ) {
		$IPPart = str_split($IP, round(strlen($IP)/2))[0];
		$SQL .= ' AND `IP` LIKE \''.$IPPart.'%\'';
	}

	$SQL .= ';';
	$SessionExists = mysqli_fetch_count($Connection, $SQL);
	return $SessionExists;

}
