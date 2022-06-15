<?php
defined('MINT') || die;

/**
 * Botstrap app
 * 
 * Este proceso configura las constantes de ruta, carga nuestro
 * cargador automático, junto con el de Composer, carga nuestras funciones 
 * y activa un arranque específico del entorno.
 * 
 * @package
 */

define('ABS_PATH',dirname( __DIR__) . DIRECTORY_SEPARATOR);
//Defines
require_once 'inc/defines.php';

//Autoloader PSR4
require_once 'inc/autoload.php';

//Functions 
require_once 'inc/functions.php';

return new Mint\App();