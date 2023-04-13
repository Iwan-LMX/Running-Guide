<?php
    class showExer{
        private $exercise_id;
        public function __construct(){
            //获取user目前对应的exercise_id
            require "Config/database.php";
            session_start();
            //查看表user用户名与密码和传输值是否相等
            $sql = "SELECT * FROM user WHERE username = '$_SESSION[Username]'";
            //result必需规定由 mysqli_query()、mysqli_store_result() 或 mysqli_use_result() 返回的结果集标识符。
            $result = mysqli_query($connID,$sql);
            $num = mysqli_num_rows($result);//函数返回结果集中行的数量
            if($num){
                $this->exercise_id = $result->fetch_all()[0][3];
                if($this->exercise_id){
                    return $this->exercise_id;
                }else   {return null;}
            }else{
                return null;
            }
        }
    }