<?php
// define information connect database
define('DATASOURCE', 'Database/Mysql');
define('HOST', 'localhost');
define('USER_DB', 'root');
define('PASSWORD', '');
define('DATABASE', 'todo-list');
define('ENCODING', 'utf8');

// define default action
define('DEFAULT_CONTROLLER', "WorksController");
define('DEFAULT_ACTION', "showWorks");

// define content message
define('ERR_CONNECT_DB', "connect database failed" . PHP_EOL);

//define path error.log
define('PATH_ERROR_LOG', "./log/error.log");

?>