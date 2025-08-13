<?php

namespace Engine\Core\Auth;

use Engine\Core\Cookie;
class Auth implements AuthInterface
{
    protected $authorized = false;
    protected $user;

    /**
     * @return mixed
     */
    public function authorized()
    {
        return $this->authorized;
    }

    /**
     * @return mixed
     */
    public function user()
    {
        return $this->user;
    }

    /**
     * @param $user
     * @return void
     */
    public function autorize($user)
    {
        Cookie::set('auth.authorized', true);
        Cookie::set('auth.user', $user);

        $this->authorized = true;
        $this->user       = $user;
    }
    public function unAuthorize()
    {
        Cookie::delet('auth.authorized');
        Cookie::delet('auth.user');

        $this->authorized = false;
        $this->user       = null;
    }

    public static function salt()
    {
        return (string) rand(1000000, 9999999);
    }

    public static function ancryptPassword($password, $salt = '')
    {
        return hash('sha 256', $password . $salt);
    }
}
