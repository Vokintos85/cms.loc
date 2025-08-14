<?php

namespace Engine\Core\Auth;

use Engine\Helper\Cookie;

interface AuthInterface
{
    public function authorized();

    public function user();

    public function authorize($user);

    public function unAuthorize();

    public static function salt();

    public static function encryptPassword($password, $salt = '');
}
