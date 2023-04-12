<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传数据</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="./cssStore/myCss.css" media="screen"/>
</head>
<body>
<div class='fatherContainer'>
    <!--导航栏-->
    <?php include("./IncludesHTML/header.html"); ?>

    <div class="cell-2">
        <!--上传的运动数据文件-->
        <?php include('./IncludesHTML/dataCenter/upload.php');?>

        <!--列表展示数据图节点的详细数据内容-->


    </div>
    <!--Footer-->
    <?php include("./IncludesHTML/footer.html"); ?>
</div>

</body>
</html>