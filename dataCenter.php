<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传数据</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="./cssStore/myCss.css" media="screen"/>
    <style>
        .child-grid{
            display: grid;
            align-content: center;
            justify-content: center;
            height: 650px;
            background-color: aquamarine;
            grid-template-columns:  1fr 1fr;
            grid-template-rows: 1fr 1fr;
        }
    </style>
</head>
<body>
<div id='fatherContainer'>
    <!--导航栏-->
    <?php include("./Includes/header.html"); ?>

    <div class="cell-2 child-grid">
        <!--上传的运动数据文件-->
        <?php include('./Includes/dataCenter/upload.php');?>

        <!--列表展示数据图节点的详细数据内容-->


    </div>
    <!--Footer-->
    <?php include("./Includes/footer.html"); ?>
</div>

</body>
</html>