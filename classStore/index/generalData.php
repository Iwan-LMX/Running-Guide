<style>
    .table11_7 table {
        width:100%;
        margin:15px 0;
        border:0;
    }
    .table11_7 th {
        background-color:#00A5FF;
        color:#FFFFFF
    }
    .table11_7,.table11_7 th,.table11_7 td {
        width: 450px;
        font-size:0.95em;
        text-align:center;
        padding:15px;
        border-collapse:collapse;
    }
    .table11_7 th,.table11_7 td {
        border: 1px solid #2087fe;
        border-width:1px 0 1px 0;
        border:2px inset #ffffff;
    }
    .table11_7 tr {
        border: 1px solid #ffffff;
    }
    .table11_7 tr:nth-child(odd){
        background-color:#aae1fe;
    }
    .table11_7 tr:nth-child(even){
        background-color:#ffffff;
    }
    .table11_7 td:nth-child(2){
        width: 35%;
    }
</style>
<?php
    require_once "Config/database.php";
    session_start();

?>
<table class=table11_7>
    <tr>
        <td>用户名</td>
        <td>root</td>
    </tr>
    <tr>
        <td>当前能力等级</td>
        <td>Level: 5</td>
    </tr>
    <tr>
        <td>最新跑力值</td>
        <td><?php echo $_COOKIE["quotient"]?></td>
    </tr>
    <tr>
        <td>最近一次跑步时间</td>
        <td><?php echo $_COOKIE["date"]?></td>
    </tr>
    <tr>
        <td>本周跑步次数</td>
        <td><?php echo $_COOKIE["works"]?></td>
    </tr>
</table>
