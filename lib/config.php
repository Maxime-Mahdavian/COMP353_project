<?php
//This is the file for all initialization and connection to the db.


error_reporting(E_ALL & ~E_NOTICE);

define('DB_HOST', 'localhost');
define('DB_NAME', 'poll');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'dummy');
define('DB_PASSWORD', 'something');
// PATH - AUTO
define('PATH_LIB', __DIR__ . DIRECTORY_SEPARATOR);
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


?>