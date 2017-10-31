<?php namespace RootStudio;

/**
 * Class Base
 *
 * @package RootStudio
 * @author James Wigger <james@rootstudio.co.uk>
 */
class Base
{
    /**
     * Root directory path
     *
     * @var string
     */
    protected $basePath;

    /**
     * Base constructor.
     *
     * @param null|string $basePath
     */
    public function __construct($basePath = null)
    {
        if ($basePath) {
            $this->setBasePath($basePath);
        }
    }

    /**
     * Set a the root directory path
     *
     * @param $basePath
     *
     * @return $this
     */
    public function setBasePath(string $basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        return $this;
    }

    /**
     * Return path to root directory
     *
     * @return string
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }

    /**
     * Return path to public directory
     *
     * @return string
     */
    public function getPublicPath(): string
    {
        if (!defined('BASE_PUBLIC_DIR')) {
            define('BASE_PUBLIC_DIR', 'public');
        }

        return $this->getBasePath() . DIRECTORY_SEPARATOR . BASE_PUBLIC_DIR;
    }

    /**
     * Return path to layout directory
     *
     * @return string
     */
    public function getLayoutPath(): string
    {
        if (!defined('BASE_LAYOUT_DIR')) {
            define('BASE_LAYOUT_DIR', 'layouts');
        }

        return $this->getPublicPath() . DIRECTORY_SEPARATOR . BASE_LAYOUT_DIR;
    }
}
