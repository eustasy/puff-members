<?php

////	Puff Members Settings
//
// BCRYPT
$Sitewide['Settings']['Members']['Password Retention']['BCRYPT'] = true;
// Oldest date to keep a password from.
// 365 days = 60*60*24*365 = 44676000
// DO NOT SET TO 0
$Sitewide['Settings']['Members']['Password Retention']['Oldest'] = 44676000;
// Prompt the user when using an old password to try and log in.
$Sitewide['Settings']['Members']['Password Retention']['Prompt on old password'] = false;

// Version
$Sitewide['Version']['Members'] = '0.5.0';
