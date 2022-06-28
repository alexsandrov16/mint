<?php

namespace Mint\Controller;

use Mint\Theme\Theme;

defined('MINT') || die;

/**
 * undocumented class
 */
class FrontPage
{
    public function index()
    {
        return view(__FUNCTION__, [
            'title' => env('title'),
            'description' => env('description'),
            'page' => new Theme
        ]);
    }
}
