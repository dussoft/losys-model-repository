<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit48cdde0b0c4fa7068586b83c650daaa0
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Referenzverwaltung\\ModelPhoto\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Referenzverwaltung\\ModelPhoto\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit48cdde0b0c4fa7068586b83c650daaa0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit48cdde0b0c4fa7068586b83c650daaa0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit48cdde0b0c4fa7068586b83c650daaa0::$classMap;

        }, null, ClassLoader::class);
    }
}
