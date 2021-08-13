<?php


namespace DaiChong\SharePoster;

/**
 * Class CopyMerge
 * @package DaiChong\SharePoster
 */
class CopyMerge
{
    private $dstIm;

    private $srcIm;

    private $dstX = 0;

    private $dstY = 0;

    private $srcW;

    private $srcH;

    private $pct = 100;

    /**
     * merge
     * @return mixed
     */
    public function merge()
    {
        if (!$this->getSrcW() || !$this->getSrcH()) {
            $this->setSrcW(imagesx($this->srcIm));
            $this->setSrcH(imagesy($this->srcIm));
        }

        @imagecopymerge($this->dstIm, $this->srcIm, $this->dstX, $this->dstY, 0, 0, $this->srcW, $this->srcH, $this->pct);
        return $this->dstIm;
    }

    /**
     * setResource
     * @param $dstIm
     * @param $srcIm
     * @return $this
     */
    public function setResource($dstIm, $srcIm)
    {
        $this->dstIm = $dstIm;
        $this->srcIm = $srcIm;
        return $this;
    }

    /**
     * setOption
     * @param $dstX
     * @param $dstY
     * @return $this
     */
    public function setOption($dstX, $dstY)
    {
        $this->dstX = $dstX;
        $this->dstY = $dstY;
        return $this;
    }

    /**
     * setSize
     * @param $srcW
     * @param $srcH
     * @return $this
     */
    public function setSize($srcW, $srcH)
    {
        $this->srcW = $srcW;
        $this->srcH = $srcH;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDstIm()
    {
        return $this->dstIm;
    }

    /**
     * @param mixed $dstIm
     */
    public function setDstIm($dstIm)
    {
        $this->dstIm = $dstIm;
    }

    /**
     * @return mixed
     */
    public function getSrcIm()
    {
        return $this->srcIm;
    }

    /**
     * @param mixed $srcIm
     */
    public function setSrcIm($srcIm)
    {
        $this->srcIm = $srcIm;
    }

    /**
     * @return mixed
     */
    public function getDstX()
    {
        return $this->dstX;
    }

    /**
     * @param mixed $dstX
     */
    public function setDstX($dstX)
    {
        $this->dstX = $dstX;
    }

    /**
     * @return mixed
     */
    public function getDstY()
    {
        return $this->dstY;
    }

    /**
     * @param mixed $dstY
     */
    public function setDstY($dstY)
    {
        $this->dstY = $dstY;
    }

    /**
     * @return mixed
     */
    public function getSrcW()
    {
        return $this->srcW;
    }

    /**
     * @param mixed $srcW
     */
    public function setSrcW($srcW)
    {
        $this->srcW = $srcW;
    }

    /**
     * @return mixed
     */
    public function getSrcH()
    {
        return $this->srcH;
    }

    /**
     * @param mixed $srcH
     */
    public function setSrcH($srcH)
    {
        $this->srcH = $srcH;
    }

    /**
     * @return mixed
     */
    public function getPct()
    {
        return $this->pct;
    }

    /**
     * @param mixed $pct
     * @return CopyMerge
     */
    public function setPct($pct)
    {
        $this->pct = $pct;
        return $this;
    }
}