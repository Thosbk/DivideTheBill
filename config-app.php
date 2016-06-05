<?php

$config_array = include('site/config.php');

if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__));
if ( !defined('LIBPATH') )
    define('LIBPATH', ABSPATH . '/lib');
if ( !defined('ACCOUNTPATH') )
    define('ACCOUNTPATH', ABSPATH . '/account');
if ( !defined('BASEURL') )
    define('BASEURL',$config_array['baseurl']);
if ( !defined('PREFIX') )
    define('PREFIX',$config_array['prefix_table']);
if ( !defined('TABLE_ACCOUNTS') )
	define('TABLE_ACCOUNTS', PREFIX.'accounts');
if ( !defined('TABLE_BILLS') )
	define('TABLE_BILLS', PREFIX.'bills');
if ( !defined('TABLE_BILL_PARTICIPANTS') )
	define('TABLE_BILL_PARTICIPANTS', PREFIX.'bill_participants');
if ( !defined('TABLE_PARTICIPANTS') )
	define('TABLE_PARTICIPANTS', PREFIX.'participants');
	if ( !defined('TABLE_PAYMENTS') )
	define('TABLE_PAYMENTS', PREFIX.'payments');

unset($config_array);