<?php

function Puff_Member_Session_Create($Connection, $Username) {

	////	Check Member Existence
	// For the sake of the space-time continuum,
	// new users should not already exist.
	$Username = Puff_Member_Sanitize_Username($Username);
	$MemberExists = Puff_Member_Exists($Connection, $Username, true);
	if ( !$MemberExists ) {
		return array('error' => 'Sorry, that user doesn\'t exist, so we can\'t make a session for it.');
	}

	////	Generate a Session
	// The Session will be a 128 character hexidecimal hash from a secure source.
	// Will return an error if no secure source is available.
	$Session = Puff_SecureRandom();
	if ( !$Session ) {
		return array('error' => 'Error: No secure source was available for Session generation. Your password could not be secured. This is not your fault.');
	}

	////	Collision Chance
	// 16 base
	// 128 characters
	// 16^128 = 1.34*10^124

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

	// TODO Consider disabling any sessions on the same IP.

	////	Insert into Database
	$SQL = 'INSERT INTO `Sessions` (`Username`, `IP`, `Session`) VALUES (\''.$Username.'\', \''.$IP.'\', \''.$Session.'\');';
	$Result = mysqli_query($Connection, $SQL);
	$Result = array('Result' => $Result, 'Session' => $Session);
	return $Result;

}
