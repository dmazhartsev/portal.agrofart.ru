<?php

class Config
{
    private static $config = array(
        'db' => array(
            'host' => 'localhost',
            'database' => '',
            'user' => '',
            'password' => '',
            'charset' => 'utf8'
        ),

        'debug' => true,

        'masterPassword' => '456321',

        'logPath' => 'xml/logreg.txt'
    );

    public static function get($key)
    {
        $keys = explode('.', $key);

        $value = self::$config;

        foreach ($keys as $k)
        {
            if (!isset($value[$k]))
            {
                return null;
            }

            $value = $value[$k];
        }

        return $value;
    }
}