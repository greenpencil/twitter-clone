<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0090fe630942485f3b39a6a0772bda21
{
    public static $fallbackDirsPsr4 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->fallbackDirsPsr4 = ComposerStaticInit0090fe630942485f3b39a6a0772bda21::$fallbackDirsPsr4;

        }, null, ClassLoader::class);
    }
}
