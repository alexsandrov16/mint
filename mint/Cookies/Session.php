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

    public function set(string $name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public function get(string $name)
    {
        if (isset($_SESSION) && $this->has($name)) {
            return $_SESSION[$name];
        }
        throw new \Exception("Undefined Session $name");
        
    }
    public function all()
    {
        if (isset($_SESSION)) {
            return $_SESSION;
        }
        throw new \Exception("Undefined Sessions");
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->all());
    }

    public function destroy(): bool
    {
        return session_destroy();
    }
}
