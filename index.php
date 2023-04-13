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
            background-color: aquamarine;
            grid-template-columns:  1fr 1fr;
            grid-template-rows: 1fr 1fr;
        }
    </style>
</head>
<body>
<div id='fatherContainer'>
    <!--导航栏-->
    <?php include("./IncludesHTML/header.html"); ?>
    <div class="cell-2 child-grid">
        <!--跑力折线图-->
        <? require 'classStore/index/quotientGraph.php'?>

        <!--概要当前身体数据-->
        <? require 'classStore/index/generalData.php'?>

        <!--今日计划摘要-->
            <? require 'classStore/index/dailyExercise.php'?>
    </div>
    <!--Footer-->
    <?php include("./IncludesHTML/footer.html"); ?>
</div>

</body>
</html>