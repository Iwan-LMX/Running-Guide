<?php

namespace Lib;


class Captach
{
    private $width;
    private $height;

    public function __construct($width = 90, $height = 30)
    {
        $this->width = $width;
        $this->height = $height;
    }

    //生成随机字符串
    private function generalCode()
    {
        $all_array = array_merge(range('a', 'z'), range('A', 'Z'), range(2, 9));
        //所有字符数组，array_merge():把多个数组连接起来，拼接成一个大的数组
        $div_array = ['l', 'o', 'O', 'I'];//去除容易混淆的字符
        $array = array_diff($all_array, $div_array);//剩余的字符数组
        unset($all_array, $div_array);//销毁不需要使用的数组
        $index = array_rand($array, 6);//随机取6个字符，返回字符下标，按先后顺序排列
        shuffle($index);//打乱字符
        $code = '';
        foreach ($index as $i):
            $code .= $array[$i];
        endforeach;
        $_SESSION['code'] = $code;//保存在会话中
        return $code;
    }

    //制作验证码图片
    public function entry()
    {
        $code = $this->generalCode();
        $image = imagecreate($this->width, $this->height);
        imagecolorallocate($image, 0, rand(0, 255), 255);//分配beijingse
        $color = imagecolorallocate($image, 213, 255, rand(0, 255));//分配前景色
        $font = 5;//内置5号字体
        $x = (imagesx($image) - imagefontwidth($font) * strlen($code)) / 2;
        $y = (imagesy($image) - imagefontheight($font)) / 2;
        imagestring($image, $font, $x, $y, $code, $color);
        header('content-type:image/jpeg');
        imagejpeg($image);
    }

    public function check($code)
    {
        return strtoupper($code) == strtoupper($_SESSION['code']);;
    }
}
