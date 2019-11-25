<?php
class Cookie
{
    public static function exists(string $name) : bool
    {
        return (isset($_COOKIE[$name])) ? true : false;
    }

    public static function get(string $name) : string
    {
        return $_COOKIE[$name];
    }

    public static function put(string $name, string $value, int $expiry) : bool
    {
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }

        return false;
    }

    public static function delete(string $name)
    {
        self::put($name, '', time() - 1);
    }
}