<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>挑选训练计划</title>
    <!--调用css-->
    <link rel="stylesheet" type="text/css" href="./cssStore/myCss.css" media="screen"/>
    <style>
        .child-grid{
            display: grid;
            align-content: center;
            justify-content: center;
            height: 650px;
            grid-template-columns:  repeat(2, 1fr);
            grid-template-rows: repeat(3, 1fr);
        }
        .child-grid > .item1{
            grid-area: calendar;
            grid-row: 1/3;
            grid-column: 1/2;
            align-self: center;
            justify-self: center;
        }
        .child-grid > .item2{
            grid-area: button;
            grid-row: 3/4;
            grid-column: 1/2;
            margin-left: auto;
            margin-right: auto;
        }
        .child-grid > .item3{
            grid-area: describe1;
            grid-row: 1/4;
            grid-column: 2/3;
            height: 100%;
            width: 100%;
            align-self: center;
            justify-self: center;
        }
    </style>
    <!--引入JavaScript-->
    <link rel="stylesheet" href="cssStore/jquery-ui.css">
    <script src="Includes/js/jquery-3.6.0.js"></script>
    <script src="Includes/js/jquery-ui.js"></script>
</head>
<body>
<div id='fatherContainer'>
    <!--导航栏-->
    <?php include("./Includes/header.html"); ?>

    <div class="cell-2 child-grid">
        <!--再划分容器左右为主框架-->
        <!--日历视图查看训练计划-->
        <div class="item1" id="datepicker"></div>
        <?php
            require_once "classStore/training/calendar.php";
        ?>

        <!--AI生成计划-->
        <div class="item2">
        <?php
            require_once "classStore/training/showExer.php";
            require_once "classStore/training/aiTrains.php";
            error_reporting(E_ERROR); //关闭warning
            session_start();
            $disable = "disabled";
            if($_SESSION["Username"]){
                $exercise = new showExer($_SESSION["Username"]);
                if( !$exercise->exercise_id || $exercise->expire){
                    $disable="";
                }
            }
            echo '<form action="" method="post"> <button '.$disable.' value="true" name="create">AI生成训练计划</button> </form>';
            if(isset($_POST["create"])){
                //选中创建计划, startdate是通过日历视图获取的
                $startdate = $_GET["date"];
                $aiCreate = new aiTrains($startdate,"publicFile/UserExe");
            }
        ?>
        </div>
        <!--训练详细描述-->
        <div class="item3">
            <?php require_once "classStore/training/showDetails.php"?>
        </div>
    </div>
    <!--Footer-->
    <?php include("./Includes/footer.html"); ?>
</div>

</body>
</html>