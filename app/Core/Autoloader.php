<?php

class Autoloader
{
    public static function register()
    {
        spl_autoload_register(array('Autoloader', 'autoload'));
    }

    public static function autoload($class)
    {
        $directories = array(
            __DIR__,
            dirname(__DIR__) . '/Controllers',
            dirname(__DIR__) . '/Models',
            dirname(__DIR__) . '/Repositories',
            dirname(__DIR__) . '/Services'
        );

        foreach ($directories as $directory)
        {
            $file = $directory . '/' . $class . '.php';

            if (file_exists($file))
            {
                require_once $file;
                return;
            }
        }
    }
}