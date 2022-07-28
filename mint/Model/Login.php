<?php

namespace Mint\Model;

use Mint\Cookies\Session;
use Mint\File\Json;

defined('MINT') || die;

/**
 * undocumented class
 */
class Login
{

    public function logOn(array $post)
    {
        if ($this->checkUser($post['user'])) {
            $data = Json::get(_USRS . $post['user']);
            if ($this->checkPass($post['pass'], $data['hash'])) {
                #Session
                Session::set('active', true);
                Session::set('username', $data['name']);

                return redirect('admin');
            }
            return 'Clave de seguridad inválida';
        }

        return 'Usuario inválido';
    }

    static function logOff()
    {
        Session::destroy();
    }

    private function checkUser(string $user)
    {
        return file_exists(_USRS . "$user.json") ? true : false;
    }

    private function checkPass(string $pass, string $hash)
    {
        return password_verify($pass, $hash) ? true : false;
    }
}
