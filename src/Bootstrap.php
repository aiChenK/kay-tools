<?php

namespace KayTools;

class Bootstrap
{
    const DIR_GLUE = DIRECTORY_SEPARATOR;
    const NS_GLUE  = '\\';

    public static function init()
    {
        spl_autoload_register(array('\KayTools\Bootstrap', 'autoload'));
    }

    public static function autoload($className)
    {
        self::_autoload(dirname(__DIR__), $className);
    }

    private static function _autoload($base, $className)
    {
        $parts = explode(self::NS_GLUE, $className);
        $parts[0] = 'src';
        $path  = $base . self::DIR_GLUE . implode(self::DIR_GLUE, $parts) . '.php';

        if (file_exists($path)) {
            require_once($path);
        }
    }
}
