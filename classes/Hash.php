<?php
class Hash
{
    public static function make($string)
    {
        return hash('sha256', $string);
    }

    public static function salt($length)
    {
        $bytes = random_bytes($length);
        return bin2hex($bytes);
    }

    public static function unique()
    {
        return self::make(uniqid());
    }
}