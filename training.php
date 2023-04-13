<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>挑选训练计划</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="./cssStore/myCss.css" media="screen"/>
</head>
<body>
<div class='fatherContainer'>
    <!--导航栏-->
    <?php include("./IncludesHTML/header.html"); ?>

    <div class="cell-2">
        <!--再划分容器左右为主框架-->
        <!--日历视图查看训练计划-->
        <?php

        ?>
        <!--AI生成计划-->
        <?php
            require_once "classStore/training/showExer.php";
            require_once "classStore/training/aiTrains.php";
            session_start();
            $disable = "disabled";
            error_reporting(E_ERROR); //关闭warning
            if($_SESSION["Username"]){
                $exercise = new showExer($_SESSION["Username"]);
                if( $exercise->exercise_id || $exercise->expire){
                    $disable="";
                }
            }
            echo '<form action="" method="post"> <button '.$disable.' value="true" name="create">AI生成训练计划</button> </form>';
            if(isset($_POST["create"])){
                //选中创建计划, startdate是通过日历视图获取的
                $startdate = $end = date('Y-m-d', time());
                $aiCreate = new aiTrains($startdate,"publicFile/UserExe");
            }
        ?>
        <!--训练详细描述-->


    </div>
    <!--Footer-->
    <?php include("./IncludesHTML/footer.html"); ?>
</div>

</body>
</html>