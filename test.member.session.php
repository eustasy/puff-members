<?php
	require_once __DIR__.'/_puff/sitewide.php';
	$Page['Type']  = 'Test';

	$Connection = $Sitewide['Database']['Connection'];
	$Username = '__AUTOTESTING__';

	echo 'Puff_Member_Create'.PHP_EOL;
	$Result = Puff_Member_Create($Connection, $Username, 'Password1');
	var_dump($Result);

	echo 'Puff_Member_Session_Create'.PHP_EOL;
	$Result = Puff_Member_Session_Create($Connection, $Username);
	var_dump($Result);

	echo 'Puff_Member_Session_Disable'.PHP_EOL;
	$Result = Puff_Member_Session_Disable($Connection, $Result['Session']);
	var_dump($Result);

	echo 'Puff_Member_Session_Create'.PHP_EOL;
	$Result = Puff_Member_Session_Create($Connection, $Username);
	var_dump($Result);

	echo 'Puff_Member_Session_Create'.PHP_EOL;
	$Result = Puff_Member_Session_Create($Connection, $Username);
	var_dump($Result);

	echo 'Puff_Member_Session_Disable_All'.PHP_EOL;
	$Result = Puff_Member_Session_Disable_All($Connection, $Username);
	var_dump($Result);

	echo 'Puff_Member_Destroy'.PHP_EOL;
	$Result = Puff_Member_Destroy($Connection, $Username);
	var_dump($Result);
