<?php
error_reporting(E_ALL);

date_default_timezone_set('America/Bogota');

ini_set('ignore_repeated_errors', TRUE);

ini_set('display_errors', FALSE);

ini_set('log_errors', TRUE);

ini_set('error_log', "php-error.log");

require 'vendor/autoload.php';
require 'src/lib/routes.php';