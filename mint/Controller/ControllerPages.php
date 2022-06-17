<?php

namespace Mint\Controller;

defined('MINT') || die;

/**
 * undocumented class
 */
class ControllerPages
{
    public function __construct()
    {
        
    }

    public function home()
    {
        echo <<<HTML
        <h1 style="text-align:center">Hola Mundo!</h1>
        HTML;
    }

    public function page()
    {
        # code...
    }
}
