<?php
defined('MINT') || die;

/**
 * @package Mint
 */
//
define('START_MEMORY', memory_get_usage());
define('START_TIME', microtime(true));

//Directory
define('DS', DIRECTORY_SEPARATOR);
define('_BIN', ABS_PATH . 'bin');
define('_BCKP', ABS_PATH . 'content' . DS . 'backup' . DS);
define('_CFG', ABS_PATH . 'content' . DS . 'config' . DS);
define('_DAT', ABS_PATH . 'content' . DS . 'data' . DS);
define('_LOGS', ABS_PATH . 'content' . DS . 'logs' . DS);
define('_PAGES', ABS_PATH . 'content' . DS . 'pages' . DS);
define('_PLUGINS', ABS_PATH . 'content' . DS . 'plugins' . DS);
define('_THEMES', ABS_PATH . 'content' . DS . 'themes' . DS);
//define('_CFG', ABS_PATH . 'content' . DS . 'themes' . DS);
