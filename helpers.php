<?php

use RootStudio\Base;
use RootStudio\BaseLayout;

/**
 * Return path to document root
 *
 * @param string $path
 *
 * @return string
 */
if (!function_exists('base_public_path')) {
    function base_public_path(string $path = ''): string
    {
        if (!defined('BASE_PUBLIC_PATH')) {
            define('BASE_PUBLIC_PATH', '/../../../../');
        }
        $Base = new Base(realpath(__DIR__ . BASE_PUBLIC_PATH));

        $userPath = $Base->getPublicPath() . ($path ? '/' . trim($path, '/') : $path);

        return $userPath;
    }
}

/**
 * Parse manifest and output versioned asset path
 *
 * @param string $path
 * @param string $manifestDirectory
 *
 * @return string
 * @throws Exception
 */
if (!function_exists('base_asset')) {
    function base_asset(string $path, string $manifestDirectory = ''): string
    {
        static $manifest;

        $path = '/' . ltrim($path, '/');

        if ($manifestDirectory) {
            $manifestDirectory = '/' . ltrim($manifestDirectory, '/');
        }

        if (!$manifest) {
            if (!file_exists($manifestPath = base_public_path($manifestDirectory . '/mix-manifest.json'))) {
                throw new Exception('The Mix manifest does not exist.');
            }

            $manifest = json_decode(file_get_contents($manifestPath), true);
        }

        if (!array_key_exists($path, $manifest)) {
            throw new Exception(
                "Unable to locate Mix file: {$path}. Please check your " .
                'webpack.mix.js output paths and try again.'
            );
        }

        if (file_exists(base_public_path($manifestDirectory . '/hot'))) {
            return "http://localhost:8080{$manifest[$path]}";
        }

        return $manifestDirectory . $manifest[$path];
    }
}

/**
 * Include a layout file
 *
 * @param string $file
 * @param array  $data
 * @param bool   $return
 *
 * @return string|void
 *
 * @throws Exception
 */
if (!function_exists('base_layout')) {
    function base_layout(string $file, array $data = [], bool $return = false)
    {
        $Base = new Base(realpath(__DIR__ . '/../../../../'));

        $BaseLayout = BaseLayout::fetch();
        $BaseLayout->setLayoutVars($data);

        $path = $Base->getLayoutPath() . DIRECTORY_SEPARATOR . ltrim($file, '/') . '.php';

        if (!file_exists($path)) {
            throw new Exception("Unable to locate layout file: {$path}. Please check the layout exists");
        }

        if ($return) {
            flush();
            ob_start();
        }

        $BaseLayout->incrementLayoutDepth();

        include $path;

        $BaseLayout->decrementLayoutDepth();

        if ($return) {
            return ob_get_clean();
        }

        flush();
    }
}

/**
 * Echo or return a layout variable
 *
 * @param      $key
 * @param bool $return
 *
 * @return string
 */
if (!function_exists('base_layout_var')) {
    function base_layout_var(string $key, bool $return = false)
    {
        $BaseLayout = BaseLayout::fetch();

        $value = $BaseLayout->getLayoutVar($key);

        if ($return) return $value;

        echo htmlentities($value);
    }
}

/**
 * Check whether layout has access to variable
 *
 * @param string $key
 *
 * @return bool
 */
if (!function_exists('base_layout_has')) {
    function base_layout_has(string $key): bool
    {
        $BaseLayout = BaseLayout::fetch();

        $value = $BaseLayout->getLayoutVar($key);

        if ($value) return true;

        return false;
    }
}

/**
 * Returns a new faker instance for mocking content
 *
 * @return Faker\Generator
 */
if (!function_exists('base_faker_factory')) {
    function base_faker_factory()
    {
        if (!class_exists('Faker\Factory')) {
            throw new Exception('Faker library is not available.');
        }

        return Faker\Factory::create();
    }
}

/**
 * Returns the full HTTP host of the current request
 *
 * @return string
 */
if (!function_exists('base_http_host')) {
    function base_http_host(): string
    {
        return 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 's' : '') . '://' . $_SERVER['HTTP_HOST'];
    }
}
