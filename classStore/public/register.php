<?php
header("content-type:text/html;charset=utf-8");
//连接数据库
require '../../Config/database.php';
//接收$_POST用户名和密码
$username=$_POST['username'];
$password=$_POST['password'];
//查看表user用户名是否存在或为空
$sql_select = "SELECT * FROM user WHERE username = '$username'";
//result必需规定由 mysqli_query()、mysqli_store_result() 或 mysqli_use_result() 返回的结果集标识符。
$select = mysqli_query($connID,$sql_select);
$num = mysqli_num_rows($select);//函数返回结果集中行的数量
if($username == "" || $password == "")
{
    echo "请确认信息完整性";
}else if($num){
    echo "已存在用户名";//已存在账户名输出错误
}else{
    $sql="insert into user(username,password) values('$username','$password')";
    $result=mysqli_query($connID,$sql);
    //判断是否注册后显示内容
    if(!$result)
    {
        echo "<script>alert('注册不成功！');window.history.back();</script>";die; //返回登录页面
    }
    else
    {
        $data = $result->fetch_all();
        session_start();
        $_SESSION['UserID'] = $data[0][0];
        $_SESSION['Username'] = $username;
        $_SESSION['Password'] = $password;
        echo '<script>alert("注册成功!");location.href="../../index.php";</script>;';
    }
}

?>
