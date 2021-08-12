<?php


namespace DaiChong\SharePoster;

use Exception;

/**
 * Class Color
 * @package DaiChong\SharePoster
 */
class Color
{
    /**
     * colorName
     * @var string
     */
    private $colorName;

    /**
     * imgResource
     * @var resource
     */
    private $imgResource;

    /**
     * setImgResource
     * @param $resource
     * @return $this
     */
    public function setImgResource($resource)
    {
        $this->imgResource = $resource;
        return $this;
    }

    /**
     * setName
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->colorName = $name;
        return $this;
    }

    /**
     * getColor
     * @throws Exception
     */
    public function getColor()
    {
        if (method_exists($this, $this->colorName)) {
            $fun = $this->colorName;
            return $this->$fun();
        } else {
            throw new Exception('color non-existent');
        }
    }

    /**
     * red
     * @return false|int
     */
    public function red()
    {
        file_put_contents('./1.txt', 222);
        return $this->create(255, 0, 0);
    }

    /**
     * black
     * @return false|int
     */
    public function black()
    {
        return $this->create(0, 0, 0);
    }

    /**
     * green
     * @return false|int
     */
    public function green()
    {
        return $this->create(0, 255, 0);
    }

    /**
     * blue
     * @return false|int
     */
    public function blue()
    {
        return $this->create(0, 0, 255);
    }

    /**
     * cyan
     * @return false|int
     */
    public function cyan()
    {
        return $this->create(0, 255, 255);
    }

    /**
     * purple
     * @return false|int
     */
    public function purple()
    {
        return $this->create(255, 0, 255);
    }

    /**
     * create colorResource
     * @param $red
     * @param $green
     * @param $blue
     * @return false|int
     */
    public function create($red, $green, $blue)
    {
        return imagecolorallocate($this->imgResource, $red, $green, $blue);
    }
}