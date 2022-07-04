<?php

namespace Mint\Controller;

use Mint\Cookies\Session;

defined('MINT') || die;

/**
 * undocumented class
 */
class Dashboard
{
    public function __construct()
    {
        $this->session = new Session([
            'name' => env('session_name')
        ]);

        $this->session->start();
    }

    public function index()
    {
        if ($this->session->has('active')) {
            echo 'Dashboard';
            return;
        }
        echo 'login';
    }
}