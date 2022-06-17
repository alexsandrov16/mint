<?php

namespace Mint\File;

defined('MINT') || die;

/**
 * undocumented class
 */
class Json
{
    static function get(string $file)
    {
        return json_decode(file_get_contents($file.'.json'), true);
    }

    static function set(string $file)
    {
        //return json_encode();
    }
}
