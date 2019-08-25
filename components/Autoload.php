<?php 

function __autoload($class_name)
{
    $array_path = [
        '/models/',
        '/components/',
        '/controllers/',
    ];

    foreach ($array_path as $path) 
    {
        $class = ROOT . $path . $class_name . '.php';
        if (is_file($class)) {
            include_once $class;
        }
    }
}

spl_autoload_register("__autoload");