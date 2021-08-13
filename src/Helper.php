<?php

namespace DaiChong\SharePoster;

/**
 * Class Helper
 * @package DaiChong\SharePoster
 */
class Helper
{
    /**
     * look
     * @param $imgResource
     */
    public function look($imgResource)
    {
        ob_clean();
        ob_end_clean();
        header('Content-Type: image/png');
        imagepng($imgResource);
        imagedestroy($imgResource);
    }

    /**
     * 保存图片到指定路径
     * @param $imgResource
     * @param $filePath
     */
    public function save($imgResource, $filePath)
    {
        ob_clean();
        ob_end_clean();
        imagepng($imgResource, $filePath);
        imagedestroy($imgResource);
    }

    /**
     * createImageFromFile
     * @param $file
     * @return false|resource
     */
    public function createImageFromFile($file)
    {
        if (preg_match('/http(s)?:\/\//', $file)) {
            $fileSuffix = $this->getNetworkImgType($file);
        } else {
            $file_info = getimagesize($file);
            $fileSuffix = $file_info[2];
        }

        if (!$fileSuffix) return false;

        switch ($fileSuffix) {
            case '2':
                $theImage = @imagecreatefromjpeg($file);
                break;
            case '3':
                $theImage = @imagecreatefrompng($file);
                break;
            case '1':
                $theImage = @imagecreatefromgif($file);
                break;
            default:
                $theImage = @imagecreatefromstring(file_get_contents($file));
                break;
        }

        return $theImage;
    }

    /**
     * getNetworkImgType
     * @param $url
     * @return false|mixed|string
     */
    public function getNetworkImgType($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_exec($ch);
        $http_code = curl_getinfo($ch);
        curl_close($ch);

        if ($http_code['http_code'] == 200) {
            $theImgType = explode('/', $http_code['content_type']);

            if ($theImgType[0] == 'image') {
                return $theImgType[1];
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * filterSpecialChars
     * @param $text
     * @return string|string[]|null
     */
    public function filterSpecialChars($text)
    {
        $a = json_encode($text);
        $b = preg_replace("/\\\ud([8-9a-f][0-9a-z]{2})/i", "", $a);
        $text = json_decode($b);
        $pattern = "/[\x{3400}-\x{4DB5}\x{4E00}-\x{9FA5}\x{9FA6}-\x{9FBB}\x{F900}-\x{FA2D}\x{FA30}-\x{FA6A}\x{FA70}-\x{FAD9}\x{FF00}-\x{FFEF}\x{2E80}-\x{2EFF}\x{3000}-\x{303F}\x{31C0}-\x{31EF}\x{2F00}-\x{2FDF}\x{2FF0}-\x{2FFF}\x{3100}-\x{312F}\x{31A0}-\x{31BF}\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{31F0}-\x{31FF}\x{AC00}-\x{D7AF}\x{1100}-\x{11FF}\x{3130}-\x{318F}\x{4DC0}-\x{4DFF}\x{A000}-\x{A48F}\x{A490}-\x{A4CF}\x{2800}-\x{28FF}\x{3200}-\x{32FF}\x{3300}-\x{33FF}\x{2700}-\x{27BF}\x{2600}-\x{26FF}\x{FE10}-\x{FE1F}\x{FE30}-\x{FE4F}0-9a-zA-Z—\x{21}-\x{7e}\x{00}-\x{ff}]/ui";
        $filterStr = preg_replace($pattern, '', $text);
        $filterPattern = addslashes("/" . $filterStr . "/ui");
        return preg_replace($filterPattern, '', $text);
    }

    /**
     * autoWrap
     * @param $fontsize
     * @param $angle
     * @param $fontFace
     * @param $string
     * @param $width
     * @return string
     */
    public function autoWrap($fontsize, $angle, $fontFace, $string, $width)
    {
        $content = "";
        for ($i = 0; $i < mb_strlen($string); $i++) {
            $letter[] = mb_substr($string, $i, 1);
        }

        foreach ($letter as $l) {
            $teststr = $content . "" . $l;
            $testbox = imagettfbbox($fontsize, $angle, $fontFace, $teststr);
            if (($testbox[2] > $width) && ($content !== "")) {
                $content .= "\n";
            }
            $content .= $l;
        }
        return $content;
    }
}