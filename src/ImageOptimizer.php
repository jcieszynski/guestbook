<?php

namespace App;

use Imagine\Gd\Imagine;
use Imagine\Image\Box;

class ImageOptimizer
{
    private const MAX_WIDTH = 200;
    private const MAX_HEIGHT = 150;

    private $imagine;

    public function __construct()
    {
        $this->imagine = new Imagine();
    }

    public function resize(string $filename): void
    {
        list($iwidth, $iheight) = getimagesize($filename);
        $radio = $iwidth / $iheight;
        $width = self::MAX_WIDTH;
        $height = self::MAX_HEIGHT;
        if ($width / $height > $radio) {
            $width = $height * $radio;
        } else {
            $height = $width / $radio;
        }

        $photo = $this->imagine->open($filename);
        $photo->resize(new Box($width, $height))->save($filename);
    }
}