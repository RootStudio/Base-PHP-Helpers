<?php namespace RootStudio;

/**
 * Class Base
 *
 * @package RootStudio
 * @author James Wigger <james@rootstudio.co.uk>
 */
class BaseLayout
{
    /**
     * Singleton instance
     *
     * @var BaseLayout;
     */
    static protected $instance;

    /**
     * Set layout variables
     *
     * @var array
     */
    private $layoutVars = [];

    /**
     * Depth of layout calls
     *
     * @var int
     */
    private $layoutDepth = 1;

    /**
     * Return instance of class
     *
     * @return BaseLayout
     */
    public static function fetch()
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }

    /**
     * Set layout variables
     *
     * @param array $data
     */
    public function setLayoutVars(array $data)
    {
        if ($this->layoutDepth > 1 && is_array($data)) {
            $this->layoutVars = array_merge($this->layoutVars, $data);
        } else {
            $this->layoutVars = $data;
        }
    }

    /**
     * Return layout variables
     *
     * @return array
     */
    public function getLayoutVars()
    {
        return $this->layoutVars;
    }

    /**
     * Return single variable by key
     *
     * @param $key
     *
     * @return mixed|string
     */
    public function getLayoutVar($key)
    {
        if (isset($this->layoutVars[$key])) {
            return $this->layoutVars[$key];
        }

        return '';
    }

    /**
     * Increase layout call depth
     */
    public function incrementLayoutDepth()
    {
        $this->layoutDepth++;
    }

    /**
     * Decrease layout call depth
     */
    public function decrementLayoutDepth()
    {
        $this->layoutDepth--;
    }
}
