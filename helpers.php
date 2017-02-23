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
    function base_layout($file, array $data = [], $return = false)
    {
        $Base = Base::fetch();
        $Base->setLayoutVars($data);

        $path = public_path('layouts/' . ltrim($file, '/') . '.php');

        if (!file_exists($path)) {
            throw new Exception("Unable to locate layout file: {$path}. Please check the layout exists");
        }

        if ($return) {
            flush();
            ob_start();
        }

        $Base->incrementLayoutDepth();

        include $path;

        $Base->decrementLayoutDepth();

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
    function base_layout_var($key, $return = false)
    {
        $Base = Base::fetch();

        $value = $Base->getLayoutVar($key);

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
    function base_layout_has($key)
    {
        $Base = Base::fetch();

        $value = $Base->getLayoutVar($key);

        if ($value) return true;

        return false;
    }
}