<?php
	require_once __DIR__.'/_puff/sitewide.php';
	$Page['Type']  = 'Test';

	$Result = Puff_Member_Session_Disable($_GET['session'], $Sitewide['Database']['Connection']);
	var_dump($Result);

