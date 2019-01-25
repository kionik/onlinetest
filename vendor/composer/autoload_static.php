<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf63f8970692126d0f4d38edcd4126edb
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'RedBeanPHP\\' => 11,
        ),
        'M' => 
        array (
            'Mirafox\\OnlineTest\\' => 19,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'RedBeanPHP\\' => 
        array (
            0 => __DIR__ . '/..' . '/gabordemooij/redbean/RedBeanPHP',
        ),
        'Mirafox\\OnlineTest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf63f8970692126d0f4d38edcd4126edb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf63f8970692126d0f4d38edcd4126edb::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
