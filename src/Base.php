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
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');

        return $this;
    }

    /**
     * Return path to root directory
     *
     * @return string
     */
    public function getBasePath()
    {
        return $this->basePath;
    }

    /**
     * Return path to public directory
     *
     * @return string
     */
    public function getPublicPath()
    {
        return $this->getBasePath() . DIRECTORY_SEPARATOR . 'public';
    }

    /**
     * Return path to layout directory
     *
     * @return string
     */
    public function getLayoutPath()
    {
        return $this->getPublicPath() . DIRECTORY_SEPARATOR . 'layouts';
    }
}
