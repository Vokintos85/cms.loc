<?php

namespace Engine\Core\Auth;

use Engine\Helper\Cookie;

interface AuthInterface
{
    public function authorized();

    public function user();

    public function authorize($userId);

    public function unAuthorize();

    public static function salt();

    public static function encryptPassword(string $password, string $salt = ''): string;
}
