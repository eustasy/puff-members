<?php
	require_once __DIR__.'/_puff/sitewide.php';
	$Page['Type']  = 'Test';
	//$Page['Title'] = 'Puff Sys';
	//$Page['Description'] = 'Puff is Awesome';
	//require_once $Sitewide['Templates']['Header'];

	$Username = 'INTERNAL_TESTING';
	$Key = 'FavColor';
	$Value = 'Blue';

	echo 'Puff_Member_Key_Create'.PHP_EOL;
	$Result = Puff_Member_Key_Create($Username, $Key, $Value, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Key_Value'.PHP_EOL;
	$Result = Puff_Member_Key_Value($Username, $Key, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Key_Update'.PHP_EOL;
	$Value = 'Red';
	$Result = Puff_Member_Key_Update($Username, $Key, $Value, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Key_Like'.PHP_EOL;
	$Result = Puff_Member_Key_Like($Username, $Key, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Key_Destroy'.PHP_EOL;
	$Result = Puff_Member_Key_Destroy($Username, $Key, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Key_Value'.PHP_EOL;
	$Result = Puff_Member_Key_Value($Username, $Key, $Sitewide['Database']['Connection']);
	var_dump($Result);

	//require_once $Sitewide['Templates']['Footer'];
