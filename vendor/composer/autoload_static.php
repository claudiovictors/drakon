<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitae1f2031e49e3f8ea811700324fa42e9
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Drakon\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Drakon\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitae1f2031e49e3f8ea811700324fa42e9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitae1f2031e49e3f8ea811700324fa42e9::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitae1f2031e49e3f8ea811700324fa42e9::$classMap;

        }, null, ClassLoader::class);
    }
}