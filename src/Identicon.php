<?php

namespace Valiner\IdenticonAvatar;

require __DIR__.'/../vendor/autoload.php';

use Valiner\IdenticonAvatar\Matrix\Matrix;
use Valiner\IdenticonAvatar\Generator\Generator;

class Identicon
{
    protected $matrix = [];
    protected $generator = '';

    public function __construct()
    {
        $this->matrix = new Matrix();
        $this->generator = new generator();
    }

    /**
     * 输出图片到浏览器
     * @param $str
     * @param int $size
     */
    public function getAvatar($str, $size = 125)
    {
        $matrixArr = $this->matrix->getMatrix($str);
        header('Content-Type: image/png');
        echo $this->generator->getImage($matrixArr, $size, $this->matrix->getColor());
        die;
    }

    /**
     * 保存图片
     * @param $str
     * @param int $size
     * @param string $path
     * @throws \Exception
     */
    public function saveAvatar($str, $size = 125, $path = '')
    {
        if (!$path) {
            throw new \Exception('路径不能为空');
        }
        $matrixArr = $this->matrix->getMatrix($str);

        try{
            imagepng($this->generator->getImageResource($matrixArr, $size, $this->matrix->getColor()), $path);
        }
        catch (\Exception $e){
            echo $e->getMessage();
        }

    }

    /**
     * 获取base64
     * @param $str
     * @param int $size
     * @return string
     */
    public function getAvatarDataUri($str, $size = 125)
    {
        $matrixArr = $this->matrix->getMatrix($str);
        $imageData = $this->generator->getImage($matrixArr, $size, $this->matrix->getColor());
        return sprintf('data:%s;base64,%s', 'image/png', base64_encode($imageData));
    }
}

$ide = new Identicon();
$ide->saveAvatar('sdp', 25,'xxx.png');