<?php

namespace DaiChong\SharePoster;

use Exception;

/**
 * Class Text
 * @package DaiChong\SharePoster
 */
class Text
{
    /**
     * 字体文件路径
     * @var string
     */
    private $fontFile;

    /**
     * fontsize
     * @var int
     */
    private $size;

    /**
     * 倾斜角度
     * @var int
     */
    private $angle;

    /**
     * x轴距离
     * @var int
     */
    private $x;

    /**
     * y轴距离
     * @var int
     */
    private $y;

    /**
     * 文字限制宽度，超过用...代替显示
     * @var int
     */
    private $fontWidth = 0;

    /**
     * 主图资源
     * @var resource
     */
    private $imgResource;

    /**
     * 是否过滤特殊字符，默认false
     * fasle:不过滤
     * true:过滤
     * @var bool
     */
    private $isFilter = false;

    /**
     * 文字颜色
     * @var resource
     */
    private $colorResource;

    /**
     * 超出显示的符号
     * @var string
     */
    private $ellipsis;

    /**
     * 文字
     * @var string
     */
    private $text;

    /**
     * 文字换行
     * @var bool
     */
    private $authWrap = false;

    /**
     * setFontFile
     * @param string $filePath
     * @return $this
     */
    public function setFontFile($filePath)
    {
        $this->fontFile = $filePath;
        return $this;
    }

    /**
     * setSize
     * @param int $size
     * @return $this
     */
    public function setSize($size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * setAngle
     * @param int $angle
     * @return $this
     */
    public function setAngle($angle)
    {
        $this->angle = $angle;
        return $this;
    }

    /**
     * setPosition
     * @param int $x
     * @param int $y
     * @return $this
     */
    public function setPosition($x = 0, $y = 0)
    {
        $this->x = $x;
        $this->y = $y;
        return $this;
    }

    /**
     * setColor
     * @param string $color
     * @param int $red
     * @param int $green
     * @param int $blue
     * @return Text
     * @throws Exception
     */
    public function setColor($color, $red = 0, $green = 0, $blue = 0)
    {
        if (is_string($color) && $color) {
            $this->colorResource = (new Color())
                ->setName($color)
                ->setImgResource($this->imgResource)
                ->getColor();
        } else {
            $this->colorResource = (new Color())
                ->setImgResource($this->imgResource)
                ->create($red, $green, $blue);
        }
        return $this;
    }

    /**
     * insert
     * @return resource
     */
    public function insert()
    {
        $helper = new Helper();
        if ($this->isFilter) {
            $this->text = $helper->filterSpecialChars($this->text);
        }
        if ($this->authWrap) {
            $this->text = $helper->autoWrap($this->size, $this->angle, $this->fontFile, $this->text, $this->fontWidth);
        } else {
            if ($this->fontWidth) {
                $this->text = mb_strimwidth($this->text, 0, $this->fontWidth, $this->ellipsis);
            }
        }
        imagettftext($this->imgResource, $this->size, $this->angle, $this->x, $this->y, $this->colorResource, $this->fontFile, $this->text);
        return $this->imgResource;
    }

    /**
     * 获取getColorResource
     * @return resource
     */
    public function getColor()
    {
        return $this->colorResource;
    }

    /**
     * setImgResource
     * @param resource $imgResource
     * @return Text
     */
    public function setImgResource($imgResource)
    {
        $this->imgResource = $imgResource;
        return $this;
    }

    /**
     * setText
     * @param string $text
     * @return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * setFontWidth
     * @param int $fontWidth
     * @return $this
     */
    public function setFontWidth($fontWidth)
    {
        $this->fontWidth = $fontWidth;
        return $this;
    }

    /**
     * setEllipsis
     * @param string $ellipsis
     * @return $this
     */
    public function setEllipsis($ellipsis)
    {
        $this->ellipsis = $ellipsis;
        return $this;
    }

    /**
     * setAutoWrap
     * @param bool $warp
     * @return $this
     */
    public function setAutoWrap($warp)
    {
        $this->authWrap = $warp;
        return $this;
    }
}