<?php
require_once __DIR__.'/../../_puff/sitewide.php';
$Page['Type']  = 'Test';

$Connection = $Sitewide['Database']['Connection'];
$Username = '__AUTOTESTING_MEMBERS__';

echo 'Puff_Member_Create'.PHP_EOL;
$Result['Create'] = Puff_Member_Create($Connection, $Username, 'Password1');
var_dump($Result['Create']); // true

echo 'Puff_Member_Password_Get'.PHP_EOL;
$Result['Get'] = Puff_Member_Password_Get($Connection, $Username);
var_dump($Result['Get']); // true

echo 'Puff_Member_Destroy'.PHP_EOL;
$Result['Destroy'] = Puff_Member_Destroy($Connection, $Username);
var_dump($Result['Destroy']); // true

if ( in_array(false, $Result, true) ) {
	exit(1);
}
