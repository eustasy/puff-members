<?php
require_once __DIR__.'/../../_puff/sitewide.php';
$Page['Type']  = 'Test';

$Connection = $Sitewide['Database']['Connection'];
$Username = '__AUTOTESTING__';
$Key = 'FavColor';
$Value = 'Blue';

echo 'Puff_Member_Key_Create'.PHP_EOL;
$Result = Puff_Member_Key_Create($Connection, $Username, $Key, $Value);
var_dump($Result);

echo 'Puff_Member_Key_Value'.PHP_EOL;
$Result = Puff_Member_Key_Value($Connection, $Username, $Key);
var_dump($Result);

echo 'Puff_Member_Key_Update'.PHP_EOL;
$Value = 'Red';
$Result = Puff_Member_Key_Update($Connection, $Username, $Key, $Value);
var_dump($Result);

echo 'Puff_Member_Key_Like'.PHP_EOL;
$Result = Puff_Member_Key_Like($Connection, $Username, $Key);
var_dump($Result);

echo 'Puff_Member_Key_Destroy'.PHP_EOL;
$Result = Puff_Member_Key_Destroy($Connection, $Username, $Key);
var_dump($Result);

echo 'Puff_Member_Key_Value'.PHP_EOL;
$Result = Puff_Member_Key_Value($Connection, $Username, $Key);
var_dump($Result);
