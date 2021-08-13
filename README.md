# share-poster
Image synthesis, image processing, personal poster image and sharing image generation, Image watermark.
# Installation
[github](https://github.com/DaiChongyu/share-poster.git) && 
composer (composer require daichong/share-poster) 

# Usage

## 合成海报图
```php
use DaiChong\SharePoster\Image;
use DaiChong\SharePoster\Helper;
use DaiChong\SharePoster\Text;

// 用一张图片创建一个图像画板
$image = new Image();
$mainBg = $image->setFile('./1.png')//设置图片路径
    ->fillWhiteBg(true) //是否填充白色背景
    ->setSize(516, 686) // 设置大小
    ->create();

// copy class 
$image1 = clone $image;
$image1->setFile('./logo.png')
    ->setSize(64, 64)
    ->setPosition(30, 555) //设置合并位置
    ->merge(); // 合并图片

// 把文字插入图片中
$text = new Text();
try {
    $text->setFontFile('./pingfang.ttf') //设置字体路径
        ->setImgResource($mainBg) //设置主图资源
        ->setPosition(110, 580) // 文字位置
        ->setSize(12) //文字大小
        ->setColor('black') //文字颜色
        ->setText('你好你好你好你好你好你好你好') //文字内容
        ->setFontWidth(200) //文字最大宽度
        ->setEllipsis('...') // 超出显示省略号
        ->setAutoWrap(true) // 是否自动换行
        ->insert();
} catch (Exception $e) {
    echo $e->getMessage();
}

(new Helper())->look($mainBg); //在浏览器查看图片

(new Helper())->save($mainBg,'./2.png'); //保存图片到指定路径
```

## 创建纯颜色画板
```php
use DaiChong\SharePoster\DrawBoard;
use \DaiChong\SharePoster\CopyMerge;
use DaiChong\SharePoster\Helper;

// 创建一个画板
$board = new DrawBoard();
$mainBg1 = $board->setSize(360, 750) //大小
    ->setColor(255, 255, 255) //颜色
    ->create();

$board1 = clone $board;
$mainBg2 = $board1->setSize(360, 100)
    ->setColor(0, 0, 0)
    ->create();

// 合并两个画板
$mainBg = (new CopyMerge())
    ->setResource($mainBg1, $mainBg2)
    ->setSize(0, 0) //是否调整大小，0表示不调整
    ->setOption(0, 0)// 合并位置
    ->merge();

(new Helper())->look($mainBg);
```
# Effect
<img src="https://github.com/DaiChongyu/phpgd-CreatePoster/blob/1.0.0/demo/success.png?raw=true">

# Contact

Problems, comments, and suggestions all welcome: daichongweb@foxmail.com
