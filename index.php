<?php

/**
 * @package Plume
 */

use Plume\App;

$memory = memory_get_usage();
$time = microtime(true);

define('PLUME', true);

//Constantes iniciales
defined('DS') || define('DS', DIRECTORY_SEPARATOR);
defined('ABS_PATH') || define('ABS_PATH', __DIR__ . DS);

//Fichero de arranque
require_once 'src/bootstrap/app.php';

$app = new App($memory, $time);

$app->run();
