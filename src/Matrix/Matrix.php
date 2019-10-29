<?php

namespace Flex\IdenticonAvatar\Matrix;

class Matrix
{

    protected $color = [];

    /**
     * 获取图片矩阵
     * @param $str
     * @param int $size
     * @return array
     */
    public function getMatrix($str, $size = 64)
    {
        $hex = md5($str);
        $hexArr = str_split($hex, 2);
        $this->setColor($this->converColor($hex));
        foreach ($hexArr as $line => $val) {
            $hexArr[$line] = (bool)round(hexdec($val) / pow(2, 7));
        }
        $matrix = $this->getMatrixArr($hexArr);
        return $matrix;
    }

    /**
     * 获取背景色
     * @param $hexadecimal
     * @return array
     */
    public function converColor($hexadecimal)
    {
        return [base_convert(substr($hexadecimal, 0, 2), 16, 10),
            base_convert(substr($hexadecimal, 2, 2), 16, 10),
            base_convert(substr($hexadecimal, 4, 2), 16, 10)];
    }


    /**
     * 组装矩阵
     * @param $hexArr
     * @return array
     */
    public function getMatrixArr($hexArr)
    {
        $matrixLeft = [];
        $matrix = [];
        for ($i = 0; $i < count($hexArr) - 1; $i++) {
            $matrixLeft[$i / 3][$i % 3] = $hexArr[$i];
        }

        array_unshift($matrixLeft, null);
        $turnMatrixLeft = array_reverse(call_user_func_array("array_map", $matrixLeft));
        array_unshift($turnMatrixLeft, null);
        $matrixRight = call_user_func_array("array_map", $turnMatrixLeft);
        array_shift($matrixLeft);

        for ($i = 0; $i < count($matrixLeft); $i++) {
            for ($j = 0; $j < count($matrixLeft); $j++) {
                if ($j <= count($matrixLeft) / 2) {
                    $matrix[$i][$j] = $matrixLeft[$i][$j];
                } else {
                    $matrix[$i][$j] = $matrixRight[$i][$j - count($matrixLeft[$i]) + 1];
                }
            }
        }
        return $matrix;
    }


    /**
     * @return array
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param array $color
     */
    public function setColor(array $color)
    {
        $this->color = $color;
    }


}
