<?php
namespace Mint\Controller;

defined('MINT') || die;

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
        $this->theme = new Theme(env('adm_theme'));

        $this->session = new Session([
            'name' => env('session_name')
        ]);

        $this->session->start();

        /*if (!$this->session->has('active')) {
            $this->login();
            die;
        }*/
    }

    public function index()
    {
        return view(__FUNCTION__, [
            'page_title' => 'Dashboard | ' . App::_name,
            'page' => $this->theme
        ], true);
    }

    public function pages()
    {
        return view(__FUNCTION__, [
            'page_title' => 'Pages | ' . App::_name,
            'page' => $this->theme
        ], true);
    }

    public function addPage($page = '')
    {
        
        return view('add', [
            'page_title' => 'Add Page | ' . App::_name,
            'page' => $this->theme
        ], true);
    }

    public function setting()
    {
        return view(__FUNCTION__, [
            'page_title' => 'Ajustes| ' . App::_name,
            'page' => $this->theme
        ], true);
    }

    public function login()
    {
        if ($_POST) {
            # code...
        }
        return view('login', [
            'page_title' => 'Iniciar Sesión | ' . App::_name,
            'page' => $this->theme
        ], true);
    }

    public function logoff()
    {
        # code...
    }
}
