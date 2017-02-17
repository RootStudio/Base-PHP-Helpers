<?php

/**
 * Return path to document root
 *
 * @param string $path
 *
 * @return string
 */
if (!function_exists('public_path')) {
    function public_path($path = '')
    {
        return $_SERVER['DOCUMENT_ROOT'] . ($path ? '/' . trim($path, '/') : $path);
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
if (!function_exists('mix')) {
    function mix($path, $manifestDirectory = '')
    {
        static $manifest;

        $path = '/' . ltrim($path, '/');

        if ($manifestDirectory) {
            $manifestDirectory = '/' . ltrim($manifestDirectory, '/');
        }

        if (!$manifest) {
            if (!file_exists($manifestPath = public_path($manifestDirectory . '/mix-manifest.json'))) {
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

        if (file_exists(public_path($manifestDirectory . '/hot'))) {
            return "http://localhost:8080{$manifest[$path]}";
        }

        return $manifestDirectory . $manifest[$path];
    }
}
