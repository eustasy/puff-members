<?php

$SQL = 'DELETE FROM `Runonces` WHERE `Active`=\'0\'';
$Result = mysqli_query($Sitewide['Database']['Connection'], $SQL);
if ( $Result ) {
	echo 'Success: Old Runonces were deleted.'."\n";
} else {
	echo 'Error: Old Runonces were not deleted.'."\n";
}
