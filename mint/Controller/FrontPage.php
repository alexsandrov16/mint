<?php
defined('MINT') || die;

namespace Mint\Controller;

use Mint\Helper\Theme;

/**
 * undocumented class
 */
class FrontPage
{
    public function __construct()
    {
        $this->theme = new Theme(env('web_theme'));
    }

    public function index()
    {
        return view(__FUNCTION__, [
            'page_title' => 'Home - Site',
            'page_description' => 'Pagina de inicio',
            //'description' => env('description'),
            'page' => $this->theme
        ]);
    }
}
