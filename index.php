<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="./cssStore/myCss.css" media="screen"/>
    <style>
        .child-grid{
            display: grid;
            align-content: center;
            justify-content: center;
            height: 650px; /*设置这个主内容展示高度是因为不确定设计完毕后有多高*/
            /*!*background-color: aquamarine;*! 确定子grid边界用*/
            grid-template-columns:  1fr 1fr;
            grid-template-rows: 1fr 1fr;
        }
        .child-grid > .item1{
            grid-area: graph;
            grid-row: 1/2;
            grid-column: 1/3;
        }
        .child-grid > .item2{
            grid-area: data;
            grid-row: 2/3;
            grid-column: 1/2;
        }
        .child-grid > .item3{
            grid-area: exercise;
            grid-row: 2/3;
            grid-column: 2/3;
        }
    </style>
    <!--引入Echarts可视库-->
    <script src="Includes/js/echarts.min.js"></script>
</head>
<body>
<div id='fatherContainer'>
    <!--导航栏-->
    <?php include("./Includes/header.html"); ?>
    <div class="cell-2 child-grid">
        <!--跑力折线图-->
        <div id="graph" class="item1">
            <?php require 'classStore/index/quotientGraph.php'?>
        </div>
        <!--概要当前身体数据-->
        <div class="item2">
            <?php require 'classStore/index/generalData.php'?>
        </div>

        <!--今日计划摘要-->
        <div class="item3">
            <?php require 'classStore/index/dailyExercise.php'?>
        </div>
    </div>
    <!--Footer-->
    <?php include("./Includes/footer.html"); ?>
</div>

</body>
</html>