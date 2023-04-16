<?php
require_once "../Config/database.php";
header('Content-type:text/json');
error_reporting(E_ERROR);
//获取quotient表内已最后一条数据的id
if($_GET["user_id"]){
    $user_id = $_GET["user_id"];
    $sql = "SELECT * FROM user WHERE user_id = {$user_id}";
    $result = mysqli_query($connID, $sql);
    $data = $result->fetch_all();
    $username = $data[0][1];
    if ($username == $_GET["username"]) {
        //获取quotient表内已最后一条数据的id
        $sql = "SELECT * FROM quotient WHERE user_id = {$user_id}";
        $result = mysqli_query($connID, $sql);
        $num = mysqli_num_rows($result);//函数返回结果集中行的数量
        if ($num) {
            $data = $result->fetch_all();
            $arr = array();
            $arr["username"] = $username;
            $i=0;
            foreach ($data as $datum) {
                $arr["data"][$i]["date"] = $datum[2];
                $arr["data"][$i++]["quotient"] = $datum[3];
            }
            echo json_encode($arr,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
        }
    }
}
else {
    echo "API输入有误";
}

