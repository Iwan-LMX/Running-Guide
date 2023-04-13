<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="./cssStore/myCss.css" media="screen"/>
</head>
<body>
<div class='fatherContainer'>
    <!--导航栏-->
    <?php include("./IncludesHTML/header.html"); ?>
    <div class="cell-2">
        <button disabled="">test</button>
        <!--概要当前身体数据-->
            <? require 'classStore/index/generalData.php'?>

        <!--跑力折线图-->
            <? require 'classStore/index/quotientGraph.php'?>
        <!--今日计划摘要-->
            <? require 'classStore/index/dailyExercise.php'?>
    </div>
    <!--Footer-->
    <?php include("./IncludesHTML/footer.html"); ?>
</div>

</body>
</html>