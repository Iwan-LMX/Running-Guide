<?php

namespace Lib;


class Upload
{
    private $error;//保存的错误消息
    private $size;//上传的大小
    private $path;//上传的路径
    private $type;//允许上传的类型
    private $finalfilepath;//文件最终路径

    public function __construct($path, $size, $type)
    {
        $this->path = $path;
        $this->size = $size;
        $this->type = $type;
    }

    //返回错误信息
    public function getError()
    {
        return $this->error;
    }

    public function uploadOne($files)
    {
        if ($this->checkError($files)) {//没有错误就上传
            //文件上传，上传的文件保存到当天的文件中
            $foldername = date('Y-m-d');
            $folderpath = "{$this->path}/{$foldername}";//文件夹路径
            if (!file_exists($folderpath)) {
                mkdir($folderpath, 0777, true);
            }
            $filename = uniqid('', true) . strrchr($_FILES['face']['name'], '.');//文件名
            $filepath = "{$folderpath}/{$filename}";//文件路径
            $this->finalfilepath = $filepath;
            if (move_uploaded_file($files['tmp_name'], $filepath))
                return true;
            else {
                $this->error = '上传失败';
                return false;
            }
        }
    }

    //验证上传是否有误
    private function checkError($file)
    {
        //1.验证错误号
        if ($file['error'] != 0) {
            switch ($file['error']) {
                case 1:
                    $this->error = '文件大小超过了php.ini中允许的最大值,最大值是：' . ini_get('upload_max_filesize');
                    return false;
                case 2:
                    $this->error = '文件大小超过了表单允许的最大值';
                    return false;
                case 3:
                    $this->error = '只有部分文件上传';
                    return false;
                case 4:
                    $this->error = '没有文件上传';
                    return false;
                case 6:
                    $this->error = '找不到临时文件';
                    return false;
                case 7:
                    $this->error = '文件写入失败';
                    return false;
                default:
                    $this->error = '未知错误';
                    return false;
            }
        }
        //2.验证格式
        $info = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($info, $file['tmp_name']);
        if (!in_array($mime, $this->type)) {
            $this->error = '只能上传' . implode(',', $this->type) . '格式';
            return false;
        }
        //3.验证大小
        if ($file['size'] > $this->size) {
            $this->error = '文件大小不能超过' . number_format($this->size / 1024, 1) . 'K';
            return false;
        }
        //4.验证是否是HTTP上传
        if (!is_uploaded_file($file['tmp_name'])) {
            $this->error = '文件不是HTTP_POST上传的';
            return false;
        }
        return true;
    }

    public function getuploadfilepath()
    {
        return $this->finalfilepath;
    }
}
