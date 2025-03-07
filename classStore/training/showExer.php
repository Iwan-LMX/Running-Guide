<?php
    class showExer{
        private $exercise_id;
        private $expire;//是否失效 true 为是, false为否
        private $rank; //最近一次锻炼的跑步能力等级
        private $start;
        private $end;
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
                    $data = $result->fetch_all();
                    $end = strtotime($data[0][3]);
                    if (time()>$end) $this->expire = true;
                    else $this->expire = false;
                    //保存用户当前运动能力水平&&当前运动的起至日期
                    $this->rank = $data[0][4];
                    $this->end = $data[0][3];
                    $this->start = $data[0][2];
                }
            }else{
                return null;
            }
        }
        public function showone($date, $userid){
            // 读取当前userid对应的训练计划.json文件的内容
            $targetFile = "publicFile/UserExe/" . $userid .".json";
            $jsonStr = file_get_contents($targetFile);
            // 将.json字符串转换为关联数组
            $jsonArr = json_decode($jsonStr, true);
            //提取本日训练计划
            $targetData = $jsonArr[$date];
            //调取训练计划需要使用的锻炼描述
            $targetFile = "publicFile/Exercises/" . $targetData["exercise"];
            $jsonStr = file_get_contents($targetFile);
            $jsonArr = json_decode($jsonStr, true);
            //将这一天的锻炼数据以array的方式return
            $res = array();
            $res["exercise"] = $jsonArr["exercise"];
            $res["plan"] = $jsonArr["rank"][$this->rank];
            return $res;
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