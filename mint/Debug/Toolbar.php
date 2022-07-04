<?php
defined('PLUME') || die;

namespace Plume\Kernel\Debug;

/**
 * undocumented class
 */
class Toolbar
{
    public function render()
    {
        
        $memory = round((memory_get_usage() - self::$memory) / (1024 * 1024), 4);

        $time = round((microtime(true) - self::$microtime) * 1000, 4);
        echo <<<HTML
        <div class="debug">
            <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd"
                        d="M1.5 8a6.5 6.5 0 1113 0 6.5 6.5 0 01-13 0zM8 0a8 8 0 100 16A8 8 0 008 0zm.5 4.75a.75.75 0 00-1.5 0v3.5a.75.75 0 00.471.696l2.5 1a.75.75 0 00.557-1.392L8.5 7.742V4.75z">
                    </path>
                </svg>$time ms
            </span>
            
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd" d="M6.5.75a.75.75 0 00-1.5 0V2H3.75A1.75 1.75 0 002 3.75V5H.75a.75.75 0 000 1.5H2v3H.75a.75.75 0 000 1.5H2v1.25c0 .966.784 1.75 1.75 1.75H5v1.25a.75.75 0 001.5 0V14h3v1.25a.75.75 0 001.5 0V14h1.25A1.75 1.75 0 0014 12.25V11h1.25a.75.75 0 000-1.5H14v-3h1.25a.75.75 0 000-1.5H14V3.75A1.75 1.75 0 0012.25 2H11V.75a.75.75 0 00-1.5 0V2h-3V.75zm5.75 11.75h-8.5a.25.25 0 01-.25-.25v-8.5a.25.25 0 01.25-.25h8.5a.25.25 0 01.25.25v8.5a.25.25 0 01-.25.25zM5.75 5a.75.75 0 00-.75.75v4.5c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-4.5a.75.75 0 00-.75-.75h-4.5zm.75 4.5v-3h3v3h-3z"></path>
                </svg>$memory MB
            </span>
        </div>
        <style>
        .debug{position:fixed;bottom:0;left:0;height:2em;width:100%;padding:0 1em;background:#454545;color:#fff;display:flex;align-items:center;}
        .debug span{margin-right:1.15em;display:flex;line-height: 1;}.debug svg{fill:#fff;margin-right:.25em}
        </style>
        HTML;
    }
}
