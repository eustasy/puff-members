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
$queries[] = 'CREATE TABLE IF NOT EXISTS `KeyValues` (
	`Username` varchar(128) NOT NULL,
	`Key` varchar(128) NOT NULL,
	`Value` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
$queries[] = 'CREATE TABLE IF NOT EXISTS `Members` (
	`Username` varchar(128) NOT NULL,
	`Active` int(1) NOT NULL DEFAULT \'1\',
	`2FA Active` int(1) NOT NULL DEFAULT \'0\',
	`2FA Secret` varchar(16) NOT NULL,
	`PassHash` varchar(32) NOT NULL,
	`Password` varchar(128) NOT NULL,
	`Salt` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
$queries[] = 'CREATE TABLE IF NOT EXISTS `Sessions` (
	`Username` varchar(128) NOT NULL,
	`Active` int(1) NOT NULL DEFAULT \'1\',
	`Session` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;';
$queries[] = 'ALTER TABLE `KeyValues`
	ADD PRIMARY KEY (`Username`,`Key`);';
$queries[] = 'ALTER TABLE `Members`
	ADD PRIMARY KEY (`Username`), ADD KEY `Active` (`Active`);';
$queries[] = 'ALTER TABLE `Sessions`
	ADD PRIMARY KEY (`Session`), ADD KEY `Username` (`Username`);';
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
