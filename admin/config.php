<?php
	mysql_connect("localhost", "root", "") or die(mysql_error());	//Define MySQl connection
	mysql_select_db("zornitza") or die(mysql_error());	//Select database
	mysql_set_charset('utf8');	// Select MySQl charset
	date_default_timezone_set('Europe/Sofia');
?>