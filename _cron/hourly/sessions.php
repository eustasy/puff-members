<?php

$SQL = 'DELETE FROM `Sessions` WHERE `Active`=\'0\'';
$Result = mysqli_query($Sitewide['Database']['Connection'], $SQL);
if ( $Result ) {
	echo 'Success: Old Sessions were deleted.'."\n";
} else {
	echo 'Error: Old Sessions were not deleted.'."\n";
}
