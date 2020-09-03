<?php

session_start();

define('PATH_CSS', '/css/');
define('PATH_JS', '/js/');
define('PATH_IMG', '/images/');
define('PATH_TEMPLATE', '../app/templates/');

// database
define('SERVERNAME', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'hotel');

require('mvc/model.php');
require('mvc/controller.php');
require('mvc/view.php');
require('mvc/router.php');

?>