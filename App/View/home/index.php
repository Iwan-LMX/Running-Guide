<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>首页</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="<?php echo $config_front; ?>/css/public.css" media="screen"/>
</head>
<body>
<div class='fatherContainer'>
    <!--导航栏-->

    <?php include("./IncludesHTML/header.html"); ?>

    <?php echo $str1;?><?php echo $str2;?>
    <br />
    <?php
    foreach($arr as $k=>$v):
        echo $v."<br />";
    endforeach;
    ?>

    <div class="cell-2">
        <?php
        use \Core\Model;

        ?>
        <!--概要当前身体数据-->

        <!--指数分析图-->

        <!--资讯投送区-->

        <!--今日计划摘要-->

    </div>
    <!--Footer-->
    <?php include("./IncludesHTML/footer.html"); ?>
</div>

</body>
</html>