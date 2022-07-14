<?php
namespace Mint\Traits;

defined('MINT') || die;

/**
 * undocumented class
 */
trait Singleton
{
    /** @var Type $var description */
    private static $instance;

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Array $parm Description
     * @return type
     * @throws conditon
     **/
    public static function init($parm = null){
        static::$instance = (static::$instance instanceof self)? : new self($parm);
        return static::$instance;
    }
}