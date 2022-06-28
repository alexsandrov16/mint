<?php

namespace Mint;

use Mint\Config\Config;
use Mint\Debug\ErrorHandler;
use Mint\Router\Rute;

defined('MINT') || die;

/**
 * @package Mint App
 */
class App
{
    const _name = 'Mint';
    const _version = '0.6 alpha';
    const php_version = 7.4;

    /** @var Type $var description */
    protected $config;

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

        $rute->routing();
    }

    private function install()
    {
        require_once ABS_PATH . 'install.php';
    }
}
