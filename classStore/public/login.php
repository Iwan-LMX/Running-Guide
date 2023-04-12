<?php

session_start();
header("content-type:text/html;charset=utf-8");
//连接数据库
require '../../Config/database.php';
//接收$_POST用户名和密码
$username = $_POST['username'];
$password = $_POST['password'];
//查看表user用户名与密码和传输值是否相等
$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
//result必需规定由 mysqli_query()、mysqli_store_result() 或 mysqli_use_result() 返回的结果集标识符。
$result = mysqli_query($connID,$sql);
$num = mysqli_num_rows($result);//函数返回结果集中行的数量
//判断是否登录后显示或跳转
if($num){
    setcookie("Username", $username, time()+3600);
    setcookie("Password", $password, time()+3600);
    echo '<script>alert("登录成功");location.href="../../index.php";</script>;';
}else{
    echo "<script>alert('用户名或密码错误');window.history.back();</script>";die;
}
mysqli_close($connID);//关闭数据库
?>
