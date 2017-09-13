<?php

# ÆSLANMEDYA
# aslnmedya@gmail.com
# silvertakip.com

# LISANS CODE
define('LISANSCOD', 'R951?9-i3948L');

@header('Content-Type: text/html; Charset=UTF-8');

# TIMEZONE
date_default_timezone_set('Europe/Istanbul');

# FUNCTIONS
include 'config/db.php';
include 'config/insta.auth.php';


# DATABASE AYARLARI
define('MYSQL_HOST',	'localhost');
define('MYSQL_DB',		'instaloji');
define('MYSQL_USER',	'instaloji');
define('MYSQL_PASS',	'a1s2d3f4g5');

# AYARLAR
$webSettings = DB::getRow("SELECT * FROM webSettings");