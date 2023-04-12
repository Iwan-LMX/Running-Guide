<?php
require_once "classStore/dataCenter/SaveRunning.php";
class FileUploader {
    // 定义类的属性
    private $allowedTypes; // 允许上传的文件类型
    private $targetDir; // 上传文件的目标目录

    // 定义类的构造函数，接受两个参数
    public function __construct($allowedTypes, $targetDir) {
        // 初始化类的属性
        $this->allowedTypes = $allowedTypes;
        $this->targetDir = $targetDir;
        // 检查目标目录是否存在，如果不存在则创建它
        if (!is_dir($this->targetDir)) {
            mkdir($this->targetDir, 0777, true);
        }
    }

    // 定义类的方法，用于上传文件，接受一个参数
    public function uploadFile($file) {
        // 获取上传文件的类型
        $fileType = $file["type"];
        // 检查文件类型是否合法
        if (in_array($fileType, $this->allowedTypes)) {
            // 获取上传文件的临时存储位置
            $tmpName = $file["tmp_name"];
            // 获取上传文件的名称
            $fileName = $file["name"];
            // 拼接上传文件的完整路径
            $targetFile = $this->targetDir . $fileName;
            // 检查目标文件是否已存在，如果存在则提示错误
            if (file_exists($targetFile)) {
                echo "错误：文件已经存在。";
            } else {
                // 将临时文件移动到目标目录下
                if (move_uploaded_file($tmpName, $targetFile)) {

                    echo "文件上传成功。";
                    // 读取.json文件的内容
                    $jsonStr = file_get_contents($targetFile);
                    // 将.json字符串转换为关联数组
                    $jsonArr = json_decode($jsonStr, true);
                    // 清洗数据
                    $saverun = new SaveRunning($jsonArr["running_data"]);
                    // 存储跑步数据并计算跑力值
                    $saverun->Saveruns();

                } else {
                    echo "错误：文件上传失败。";
                }
            }
        } else {
            echo "错误：文件类型不合法。";
        }
    }

}
?>