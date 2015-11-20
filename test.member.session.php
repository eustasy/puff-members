<?php
	require_once __DIR__.'/_puff/sitewide.php';
	$Page['Type']  = 'Test';

	$Username = '__AUTOTESTING__';

	echo 'Puff_Member_Create'.PHP_EOL;
	$Result = Puff_Member_Create($Username, 'Password1', $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Session_Create'.PHP_EOL;
	$Result = Puff_Member_Session_Create($Username, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Session_Disable'.PHP_EOL;
	$Result = Puff_Member_Session_Disable($Result['Session'], $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Session_Create'.PHP_EOL;
	$Result = Puff_Member_Session_Create($Username, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Session_Create'.PHP_EOL;
	$Result = Puff_Member_Session_Create($Username, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Session_Disable_All'.PHP_EOL;
	$Result = Puff_Member_Session_Disable_All($Username, $Sitewide['Database']['Connection']);
	var_dump($Result);

	echo 'Puff_Member_Destroy'.PHP_EOL;
	$Result = Puff_Member_Destroy($Username, $Sitewide['Database']['Connection']);
	var_dump($Result);
