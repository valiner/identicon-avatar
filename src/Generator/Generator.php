<?php
namespace Valiner\IdenticonAvatar\Generator;

class Generator
{
    protected $generatedImage;

    public function __construct()
    {
        if (!extension_loaded('gd')) {
            throw new Exception('请安装gd库');
        }
    }

    /**
     * 获取图片资源
     * @param $matrixArr
     * @param $size
     * @param $color
     * @return resource
     */
    public function getImageResource($matrixArr,$size,$color){
        $this->generatedImage = imagecreatetruecolor($size, $size);
        $perPixel = (int)$size/5;

        $background = imagecolorallocate($this->generatedImage, 255, 255, 255);
        imagefill($this->generatedImage, 0, 0, $background);
        $gdColor = imagecolorallocate($this->generatedImage, $color[0], $color[1], $color[2]);

        foreach ($matrixArr as $lineKey => $lineValue) {
            foreach ($lineValue as $colKey => $colValue) {
                if (true === $colValue) {
                    imagefilledrectangle($this->generatedImage, $colKey * $perPixel, $lineKey * $perPixel, ($colKey + 1) * $perPixel, ($lineKey + 1) * $perPixel, $gdColor);
                }
            }
        }
        return $this->generatedImage;
    }

    public function getImage($matrixArr,$size,$color)
    {
        $imageResource =  $this->getImageResource($matrixArr,$size,$color);
        ob_start();
        imagepng($imageResource);
        $imageData = ob_get_contents();
        ob_end_clean();
        return $imageData;
    }
}

