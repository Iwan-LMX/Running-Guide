<?php

namespace Lib;


class Image
{
    private $path;

    public function __construct($src_path, $w = 50, $h = 50, $prefix = 'small_')
    {
        $this->thumb($src_path, $w, $h, $prefix);
    }

    private function thumb($src_path, $w, $h, $prefix)
    {
        $dst_img = imagecreatetruecolor($w, $h);
        //设置缩略图的背景颜色
        $color = imagecolorallocate($dst_img, rand(0, 255), rand(20, 45), rand(1, 255));
        //给目标图填充背景颜色
        imagefill($dst_img, 0, 0, $color);
        //打开原图
        $src_img = imagecreatefromjpeg($src_path);
        //复制原图拷贝到目标图上，并缩放大小
        $src_w = imagesx($src_img);
        $src_h = imagesy($src_img);
        imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, 50, 50, $src_w, $src_h);
        $foldername = substr(dirname($src_path), -10);
        $filename = basename($src_path);
        $save_path = dirname($src_path) . '/' . $prefix . $filename;
        //保存缩略图
        imagejpeg($dst_img, $save_path);
        $this->path = "{$foldername}/{$prefix}{$filename}";
    }

    public function filepath()
    {
        return $this->path;
    }
}
