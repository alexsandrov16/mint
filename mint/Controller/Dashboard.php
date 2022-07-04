<?php
defined('MINT') || die;

namespace Mint\Controller;

use Mint\App;
use Mint\Cookies\Session;
use Mint\Helper\Theme;

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

        $this->theme = new Theme(env('adm_theme'));
    }

    public function index()
    {
        if ($this->session->has('active')) {
            echo 'Dashboard';
            return;
        }
        if ($_POST) {
            # code...
        }
        return view('login',[
            'page_title' => 'Iniciar Sesión | '. App::_name,
            'page'=> $this->theme
        ],true);
    }
}