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
        $this->theme = new Theme(env('site_theme'));
    }

    public function index()
    {
        return view(__FUNCTION__, [
            'title' => env('title'),
            'description' => env('description'),
            'page' => $this->theme
        ]);
    }
}
