<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit10653949d54da763dd10521f0fd62cae
{
    public static $files = array (
        '7b11c4dc42b3b3023073cb14e519683c' => __DIR__ . '/..' . '/ralouphie/getallheaders/src/getallheaders.php',
        'c964ee0ededf28c96ebd9db5099ef910' => __DIR__ . '/..' . '/guzzlehttp/promises/src/functions_include.php',
        'a0edc8309cc5e1d60e3047b5df6b7052' => __DIR__ . '/..' . '/guzzlehttp/psr7/src/functions_include.php',
        '37a3dc5111fe8f707ab4c132ef1dbc62' => __DIR__ . '/..' . '/guzzlehttp/guzzle/src/functions_include.php',
        '9f394da3192a168c4633675768d80428' => __DIR__ . '/..' . '/nwidart/laravel-modules/src/helpers.php',
    );

    public static $prefixLengthsPsr4 = array (
        'd' => 
        array (
            'devopsteam\\modular\\' => 19,
        ),
        'P' => 
        array (
            'Psr\\Http\\Message\\' => 17,
            'Psr\\Http\\Client\\' => 16,
        ),
        'N' => 
        array (
            'Nwidart\\Modules\\' => 16,
        ),
        'G' => 
        array (
            'GuzzleHttp\\Psr7\\' => 16,
            'GuzzleHttp\\Promise\\' => 19,
            'GuzzleHttp\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'devopsteam\\modular\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
        'Psr\\Http\\Message\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-message/src',
        ),
        'Psr\\Http\\Client\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/http-client/src',
        ),
        'Nwidart\\Modules\\' => 
        array (
            0 => __DIR__ . '/..' . '/nwidart/laravel-modules/src',
        ),
        'GuzzleHttp\\Psr7\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/psr7/src',
        ),
        'GuzzleHttp\\Promise\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/promises/src',
        ),
        'GuzzleHttp\\' => 
        array (
            0 => __DIR__ . '/..' . '/guzzlehttp/guzzle/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'CzProject\\GitPhp\\CommandProcessor' => __DIR__ . '/..' . '/czproject/git-php/src/CommandProcessor.php',
        'CzProject\\GitPhp\\Commit' => __DIR__ . '/..' . '/czproject/git-php/src/Commit.php',
        'CzProject\\GitPhp\\CommitId' => __DIR__ . '/..' . '/czproject/git-php/src/CommitId.php',
        'CzProject\\GitPhp\\Exception' => __DIR__ . '/..' . '/czproject/git-php/src/exceptions.php',
        'CzProject\\GitPhp\\Git' => __DIR__ . '/..' . '/czproject/git-php/src/Git.php',
        'CzProject\\GitPhp\\GitException' => __DIR__ . '/..' . '/czproject/git-php/src/exceptions.php',
        'CzProject\\GitPhp\\GitRepository' => __DIR__ . '/..' . '/czproject/git-php/src/GitRepository.php',
        'CzProject\\GitPhp\\Helpers' => __DIR__ . '/..' . '/czproject/git-php/src/Helpers.php',
        'CzProject\\GitPhp\\IRunner' => __DIR__ . '/..' . '/czproject/git-php/src/IRunner.php',
        'CzProject\\GitPhp\\InvalidArgumentException' => __DIR__ . '/..' . '/czproject/git-php/src/exceptions.php',
        'CzProject\\GitPhp\\InvalidStateException' => __DIR__ . '/..' . '/czproject/git-php/src/exceptions.php',
        'CzProject\\GitPhp\\RunnerResult' => __DIR__ . '/..' . '/czproject/git-php/src/RunnerResult.php',
        'CzProject\\GitPhp\\Runners\\CliRunner' => __DIR__ . '/..' . '/czproject/git-php/src/Runners/CliRunner.php',
        'CzProject\\GitPhp\\Runners\\MemoryRunner' => __DIR__ . '/..' . '/czproject/git-php/src/Runners/MemoryRunner.php',
        'CzProject\\GitPhp\\StaticClassException' => __DIR__ . '/..' . '/czproject/git-php/src/exceptions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit10653949d54da763dd10521f0fd62cae::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit10653949d54da763dd10521f0fd62cae::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit10653949d54da763dd10521f0fd62cae::$classMap;

        }, null, ClassLoader::class);
    }
}
