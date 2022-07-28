<?php
namespace Mint\Cookies;

defined('MINT') || die;

/**
 * undocumented class
 */
class Session
{
    private $options;
    public function __construct(array $options = [])
    {
        $this->options = $options;
    }

    public function start(): bool
    {
        return session_start($this->options);
    }

    static function set(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }

    static function get(string $name)
    {
        if (isset($_SESSION) && self::has($name)) {
            return $_SESSION[$name];
        }
        throw new \Exception("Undefined Session $name");
        
    }
    static function all()
    {
        if (isset($_SESSION)) {
            return $_SESSION;
        }
        throw new \Exception("Undefined Sessions");
    }

    static function has(string $name): bool
    {
        return array_key_exists($name, self::all());
    }

    static function destroy(): bool
    {
        return session_destroy();
    }
}
