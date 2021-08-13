<?php

namespace DaiChong\SharePoster;

/**
 * Class DrawBoard
 * @package DaiChong\SharePoster
 */
class DrawBoard
{
    /**
     * 主画板
     * @var resource
     */
    private $bgResource;

    /**
     * 宽度
     * @var int
     */
    private $width = 0;

    /**
     * 高度
     * @var int
     */
    private $height = 0;

    /**
     * x轴
     * @var int
     */
    private $x = 0;

    /**
     * y轴
     * @var int
     */
    private $y = 0;

    private $red;

    private $green;

    private $blue;

    /**
     * @return resource
     */
    public function getBgResource()
    {
        return $this->bgResource;
    }

    /**
     * create
     * @return false|resource
     */
    public function create()
    {
        $this->bgResource = @imagecreate($this->width, $this->height);
        imagecolorallocate($this->bgResource, $this->red, $this->green, $this->blue);
        return $this->bgResource;
    }

    /**
     * @param resource $bgResource
     * @return DrawBoard
     */
    public function setBgResource($bgResource)
    {
        $this->bgResource = $bgResource;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @param int $width
     * @return DrawBoard
     */
    public function setWidth($width)
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return int
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @param int $height
     * @return DrawBoard
     */
    public function setHeight($height)
    {
        $this->height = $height;
        return $this;
    }

    /**
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param int $x
     * @return DrawBoard
     */
    public function setX($x)
    {
        $this->x = $x;
        return $this;
    }

    /**
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * setY
     * @param int $y
     * @return DrawBoard
     */
    public function setY($y)
    {
        $this->y = $y;
        return $this;
    }

    /**
     * setSize
     * @param int $width
     * @param int $height
     * @return $this
     */
    public function setSize($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
        return $this;
    }

    /**
     * setOption
     * @param int $x
     * @param int $y
     * @return $this
     */
    public function setOption($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
        return $this;
    }

    /**
     * setColor
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return DrawBoard
     */
    public function setColor($red = 0, $green = 0, $blue = 0)
    {
        $this->red = $red;
        $this->green = $green;
        $this->blue = $blue;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * @param mixed $red
     * @return DrawBoard
     */
    public function setRed($red)
    {
        $this->red = $red;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * @param mixed $green
     * @return DrawBoard
     */
    public function setGreen($green)
    {
        $this->green = $green;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * @param mixed $blue
     * @return DrawBoard
     */
    public function setBlue($blue)
    {
        $this->blue = $blue;
        return $this;
    }
}