<style>
    .table11_3 table {
        width:100%;
        margin:15px 0;
        border:0;
    }
    .table11_3 th {
        background-color:#FF5675;
        color:#FFFFFF
    }
    .table11_3,.table11_3 th,.table11_3 td {
        width: 450px;
        font-size:0.95em;
        text-align:center;
        padding:15px;
        border-collapse:collapse;
    }
    .table11_3 th,.table11_3 td {
        border: 1px solid #fe2047;
        border-width:1px 0 1px 0;
        border:2px inset #ffffff;
    }
    .table11_3 tr {
        border: 1px solid #ffffff;
    }
    .table11_3 tr:nth-child(odd){
        background-color:#fec6d1;
    }
    .table11_3 tr:nth-child(even){
        background-color:#ffffff;
    }
    .table11_3 tr:nth-child(4){
        background-color:#fec6d1;
    }
    .table11_3 tr:nth-child(5){
        background-color:#ffffff;
    }
</style>
<?php
   //确保有用户登录
    session_start();
    error_reporting(E_ERROR); //关闭warning
    if($_SESSION["Username"]){
        //连接当前训练表
        $userid = $_SESSION["UserID"];
        $exercise = new showExer($_SESSION["Username"]);
        //判断用户是否存在锻炼计划并且未失效
        if(!$exercise->expire && $exercise->exercise_id){
            //获取当前日期
            $datee = date("Y-m-d", time());
            //或得今日锻炼方案
            $dailyExercise = $exercise->showone($datee, $userid);
        }
    }
?>
<table class=table11_3 title="训练计划">
    <tr><th colspan="2">今日计划</th></tr>
    <tr>
        <td>训练名</td>
        <td><?php echo $dailyExercise["exercise"]["name"];?></td>
    </tr>
    <tr>
        <td rowspan="2">循环 <?php echo $dailyExercise["plan"]["round"]; ?> 组</td>
        <td>运动 (分:秒）: <?php echo date("i:s", $dailyExercise["plan"]["work"]);?></td>
    </tr>
    <tr>
        <td>休息 (分:秒）: <?php echo date("i:s", $dailyExercise["plan"]["break"]);?></td>
    </tr>
    <tr>
        <td rowspan="2" colspan="2">建议 : <?php echo $dailyExercise["plan"]["recommend"];?></td>
    </tr>
</table>

