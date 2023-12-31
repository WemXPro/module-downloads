<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1f7f8298eddf15e323b0fb8a6afa8fa2
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Modules\\Downloads\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Modules\\Downloads\\' => 
        array (
            0 => __DIR__ . '/../..' . '/',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit1f7f8298eddf15e323b0fb8a6afa8fa2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit1f7f8298eddf15e323b0fb8a6afa8fa2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit1f7f8298eddf15e323b0fb8a6afa8fa2::$classMap;

        }, null, ClassLoader::class);
    }
}
