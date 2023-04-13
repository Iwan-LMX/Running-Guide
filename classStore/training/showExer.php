<?php
    class showExer{
        private $exercise_id;
        private $expire;//是否失效
        public function __construct($username){
            //获取user目前对应的exercise_id并验证是否过期
            require "Config/database.php";
            //查看表user用户名与密码和传输值是否相等
            $sql = "SELECT * FROM user WHERE username = '$username'";
            //result必需规定由 mysqli_query()、mysqli_store_result() 或 mysqli_use_result() 返回的结果集标识符。
            $result = mysqli_query($connID,$sql);
            $num = mysqli_num_rows($result);//函数返回结果集中行的数量
            if($num){
                $this->exercise_id = $result->fetch_all()[0][3];
                if($this->exercise_id){
                    //验证是否已经过期
                    $sql = "SELECT * FROM `exercises` WHERE `exercise_id` ={$this->exercise_id}";
                    $result = mysqli_query($connID,$sql);
                    $end = $result->fetch_all();
                    $end = strtotime($end[0][3]);
                    if (time()>$end) $this->expire = true;
                    else $this->expire = false;
                }
            }else{
                return null;
            }
        }

        public function __get($name)
        {
            return $this->$name;
            // TODO: Implement __get() method.
        }

        public function __set($name, $value)
        {
            $this->$name = $value;
            // TODO: Implement __set() method.
        }
    }