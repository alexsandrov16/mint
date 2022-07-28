<?php
namespace Mint;

defined('MINT') || die;

use Mint\Config\Config;
use Mint\Debug\ErrorHandler;
use Mint\Router\Rute;

/**
 * @package Mint App
 */
class App
{
    const _name = 'Mint';
    const _version = '0.6 alpha';
    const php_version = 7.4;
    static $modules = ['mbstring', 'json'];

    public function __construct()
    {
        $this->requeriment();

        //iniciando configuracion
        Config::init();

        //Manejador de excepciones
        (new ErrorHandler(env('debug')))->start();

        return $this->run();
    }

    private function requeriment()
    {
        if (version_compare(PHP_VERSION, self::php_version, '<')) die(sprintf('<b>%s</b> no es compatible con PHP %s, actualice PHP a una versión superior a la <u>%s</u>', self::_name, PHP_VERSION, self::php_version));;
    }

    private function run()
    {
        if (file_exists(ABS_PATH . 'install.php')) {
            return $this->install();
        }
        $rute = new Rute;

        $rute->get('/', ['Mint\Controller\FrontPage']);

        /**
         * Dashboard
         */
        $rute->map(['get','post'], '/admin', ['Mint\Controller\Dashboard']);
        //pages
        $rute->get('/admin/pages', ['Mint\Controller\Dashboard', 'pages']);
        //add page
        $rute->map(['get','post'], '/admin/pages/add', ['Mint\Controller\Dashboard', 'addPage']);
        //edit or delete page
        $rute->map(['get','post'], '/admin/pages/(:alpha)', ['Mint\Controller\Dashboard', 'addPage']);
        //setting
        $rute->get('/admin/settings', ['Mint\Controller\Dashboard', 'setting']);
        //login and logout
        $rute->post('/admin/login', ['Mint\Controller\Dashboard','login']);
        $rute->get('/admin/off', ['Mint\Controller\Dashboard','logoff']);

        //Run
        $rute->routing();
    }

    private function install()
    {
        require_once ABS_PATH . 'install.php';
    }
}
