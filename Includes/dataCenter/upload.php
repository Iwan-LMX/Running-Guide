<?php
    session_start();
    $disable = "disabled";
    error_reporting(E_ERROR); //关闭warning
    if($_SESSION["UserID"]){
        $disable = "";
    }
?>
<body>
<form action="" method="post" enctype="multipart/form-data">
    <label for="file">选择文件：</label>
    <input type="file" name="file" id="file" class="my-button"><br>
    <input type="submit" name="submit" <?php echo $disable?> value="上传" class="my-button">
</form>
<label for="massage"></label>
</body>
<?php
// 引入PHP文件
require_once "classStore/dataCenter/FileUploader.php";
// 判断是否有文件上传
if (isset($_FILES["file"])) {
    // 创建一个文件上传类的实例，指定允许上传的文件类型和目标目录
    $fileUploader = new FileUploader(array("application/json"), "publicFile/upload/");
    // 调用类的方法，传入表单中的文件数据
    $fileUploader->uploadFile($_FILES["file"]);

}
?>
