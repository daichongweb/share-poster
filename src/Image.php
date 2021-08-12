<?php

namespace DaiChong\SharePoster;

/**
 * Class Image
 * @package DaiChong\SharePoster
 */
class Image
{
    /**
     * 图片路径
     * @var string
     */
    private $file;

    /**
     * 背景图宽度
     * @var int
     */
    private $width;

    /**
     * 背景图高度
     * @var int
     */
    private $height;

    /**
     * 待合并图的宽度
     * @var int
     */
    private $imgWidth;

    /**
     * 待合并图的高度
     * @var int
     */
    private $imgHeight;

    /**
     * x轴距离
     * @var int
     */
    private $xPixel;

    /**
     * y轴距离
     * @var int
     */
    private $yPixel;

    /**
     * 最后生成图片的资源
     * @var resource
     */
    private $bgResource;

    /**
     * 是否填充白色背景，默认false
     * false:不填充
     * ture:填充
     * @var bool
     */
    private $isFillWhiteBg = false;

    /**
     * create
     * @return false|resource
     */
    public function create()
    {
        $info = getimagesize($this->file);
        $backgroundFun = 'imagecreatefrom' . image_type_to_extension($info[2], false);
        $background = $backgroundFun($this->file);
        $backgroundWidth = imagesx($background);
        $backgroundHeight = imagesy($background);
        $imageRes = imageCreatetruecolor($this->width, $this->height);
        if ($this->isFillWhiteBg) {
            $color = imagecolorallocate($imageRes, 255, 255, 255);
            imagefill($imageRes, 0, 0, $color);
        }
        imagecopyresampled($imageRes, $background, 0, 0, 0, 0, $this->imgWidth ?: $this->width, $this->imgHeight ?: $this->height, $backgroundWidth, $backgroundHeight);
        $this->bgResource = $imageRes;
        return $imageRes;
    }

    /**
     * merge
     * @return false|resource
     */
    public function merge()
    {
        list($width, $height) = getimagesize($this->file);
        $imgBoard = (new Helper())->createImageFromFile($this->file);
        imagecopyresampled($this->bgResource, $imgBoard, $this->xPixel, $this->yPixel, 0, 0, $this->imgWidth ?: $this->width, $this->imgHeight ?: $this->height, $width, $height);
        return $imgBoard;
    }

    /**
     * setFile
     * @param string $filePath
     * @return $this
     */
    public function setFile($filePath)
    {
        $this->file = $filePath;
        return $this;
    }

    /**
     * setSize
     * @param int $bgWidth
     * @param int $bgHeight
     * @param int $imgWidth
     * @param int $imgHeight
     * @return $this
     */
    public function setSize($bgWidth = 0, $bgHeight = 0, $imgWidth = 0, $imgHeight = 0)
    {
        $this->width = $bgWidth;
        $this->height = $bgHeight;
        $this->imgWidth = $imgWidth;
        $this->imgHeight = $imgHeight;
        return $this;
    }

    /**
     * setPosition
     * @param int $xPixel
     * @param int $yPixel
     * @return Image
     */
    public function setPosition($xPixel, $yPixel)
    {
        $this->xPixel = $xPixel;
        $this->yPixel = $yPixel;
        return $this;
    }

    /**
     * fillWhiteBg
     * @param bool $bool
     * @return $this
     */
    public function fillWhiteBg($bool)
    {
        $this->isFillWhiteBg = $bool;
        return $this;
    }
}