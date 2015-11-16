<?php
	require_once __DIR__.'/_puff/sitewide.php';
	$Page['Type']  = 'Index';
	$Page['Title'] = 'Puff Sys';
	$Page['Description'] = 'Puff is Awesome';
	require_once $Sitewide['Templates']['Header'];

	$Result = Puff_Member_Create('jsmith', 'john.smith@example.com', 'Password1', $Sitewide['Database']['Connection']);
	var_dump($Result);

	require_once $Sitewide['Templates']['Footer'];
