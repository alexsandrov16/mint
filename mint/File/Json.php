<?php
defined('MINT') || die;

namespace Mint\File;

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
