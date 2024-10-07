<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>上传数据</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="./cssStore/myCss.css" media="screen"/>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="./cssStore/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="./cssStore/dataTables.jqueryui.min.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="Includes/js/jquery-1.10.2.min.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="Includes/js/jquery.dataTables.js"></script>
    <style>
        .child-grid{
            display: grid;
            align-content: center;
            justify-content: center;
            height: 650px;
            grid-template-columns:  2fr 3fr;
            grid-template-rows: 2fr 3fr;
        }
        .child-grid > .item1{
            grid-area: button;
            grid-row: 1/2;
            grid-column: 1/2;
            justify-self: center;
            align-self: center;
        }
        .child-grid > .item2{
            grid-area: table;
            grid-row: 1/3;
            grid-column: 2/3;
            padding-right: 20px;
        }
        .child-grid > .item3{
            grid-area: logo;
            grid-row: 2/3;
            grid-column: 1/2;
            padding-left: 20px;
        }
        .box{
            width: 200px;
            height: 140px;
            background-size: contain;
            display: inline-block;
            background-repeat: no-repeat;
            background-position: center center;
            float: left;
            margin-inline-end: 20px;
        }
        .my-button{

        }
    </style>
</head>
<body>
<div id='fatherContainer'>
    <!--导航栏-->
    <?php include("./Includes/header.html"); ?>

    <div class="cell-2 child-grid">
        <!--上传的运动数据文件-->
        <div class="item1">
            <?php include('./Includes/dataCenter/upload.php');?>
        </div>


        <!--列表展示数据图节点的详细数据内容-->
        <div class="item2">
            <?php
            error_reporting(0);
            require './classStore/dataCenter/showData.php';?>
        </div>

        <!--展示支持的运动类型和图标-->
        <div class="item3">
            <h3 style="text-align: center">本系统支持应用和文件类型</h3>
            <div class="box" style="background-image: url(/Includes/image/huawei_logo.webp);"></div>
            <div class="box" style="background-image: url(/Includes/image/json_logo.png);"></div>
        </div>
    </div>
    <!--Footer-->
    <?php include("./Includes/footer.html"); ?>
</div>

</body>
</html>