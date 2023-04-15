<style>
    .table11_3 table {
        height: inherit;
        margin-right:15px;
        border:0;
    }
    .table11_3 th {
        background-color:#FF5675;
        color:#FFFFFF
    }
    .table11_3,.table11_3 th,.table11_3 td {
        font-size:0.95em;
        text-align:center;
        padding:15px;
        border-collapse:collapse;
    }
    .table11_3 th,.table11_3 td {
        border: 1px solid #fe2047;
        border-width:1px 0 1px 0;
        border:2px inset #ffffff;
        width: -moz-max-content;
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
            //获取日历表中选中的日期
            $datee = $_GET["date"];
            //或得今日锻炼方案
            $dailyExercise = $exercise->showone($datee, $userid);
        }
    }
?>
<table class=table11_3 title="table1"  style="width: 660px; height: 200px">
    <tr>
        <td style="width: 30%;">训练名:</td>
        <td style="width: 70%;"><?php echo $dailyExercise["exercise"]["name"];?></td>
    </tr>
    <tr>
        <td>描述:</td>
        <td><?php echo $dailyExercise["exercise"]["describe"];?></td>
    </tr>
    <tr>
        <td>动作指导链接:</td>
        <td><a href="<?php echo $dailyExercise["exercise"]["video url"];?>" target="_blank"><?php echo $dailyExercise["exercise"]["video url"];?></a></td>
    </tr>
</table>
<br/>
<table class=table11_3 title="table2" style="width: 660px; height: 350px;">
    <tr>
        <td colspan="2" style="width: 50%;">循环 <?php echo $dailyExercise["plan"]["round"]; ?> 组</td>
    </tr>
    <tr>
        <td>运动 (分:秒）:</td>
        <td> <?php echo date("i:s", $dailyExercise["plan"]["work"]);?></td>
    </tr>
    <tr>
        <td>休息 (分:秒）:</td>
        <td><?php echo date("i:s", $dailyExercise["plan"]["break"]);?></td>
    </tr>
    <tr>
        <td>锻炼建议 :</td>
        <td><?php echo $dailyExercise["plan"]["recommend"];?></td>
    </tr>
    <tr>
        <td>开始日期: <?php echo $exercise->start;?> </td>
        <td>结束日期: <?php echo $exercise->end;?> </td>
    </tr>
</table>
