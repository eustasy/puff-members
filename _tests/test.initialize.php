<?php
require_once __DIR__.'/../_settings/core.default.php';
require_once __DIR__.'/../_settings/db.default.php';
require_once __DIR__.'/../_settings/runonce.default.php';
$test_db = mysqli_connect('127.0.0.1', 'root', '', 'PuffDB');
if ( !$test_db ) {
	echo 'Failed to connect to database for testing.';
	$failure = true;
}
$queries[] = 'GRANT ALL ON `PuffDB`.* TO '.$Sitewide['Settings']['DB']['Username'].'@localhost IDENTIFIED BY \''.$Sitewide['Settings']['DB']['Password'].'\';';
$queries[] = 'FLUSH PRIVILEGES;';
$queries[] = 'CREATE TABLE IF NOT EXISTS `Runonces` (
	`Runonce` varchar(128) NOT NULL,
	`Session` varchar(128) NOT NULL,
	`Active` int(1) NOT NULL DEFAULT \'1\'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
foreach ( $queries as $query ) {
	$result = mysqli_query($test_db, $query);
	echo 'Test initialized: ';
	var_dump($result);
	if ( !$result ) {
		echo 'Error #'.mysqli_errno($test_db).': "'.mysqli_error($test_db).'"';
		$failure = true;
	}
}
if ( !empty($failure) ) {
	exit(1);
}
