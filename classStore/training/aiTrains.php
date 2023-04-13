<?php
    class aiTrains{
        private $targetDir; //训练计划文件目录
        private $filename; //训练计划名
        private $allowedTypes;
        private $start; //开始日期
        public function __construct($start, $targetDir)
        {
            $this->start = strtotime($start);
            require "Config/database.php";
            require_once "classStore/dataCenter/Getquotient.php";
            session_start();
            //获取当前用户连续一周的跑力值
            $quotients = new Getquotient();
            $results = $quotients->weekquotients($_SESSION["UserID"]);
            if($results){
                $end = strtotime("+1 month", $this->start);
                $end = date('Y-m-d', $end);
                $num = count($results);
                $sum = 0;
                foreach ($results as $result){
                    $sum += $result[3];
                }
                //根据平均跑力值将用户划分为10个等级
                $average = $sum / $num;
                $rank = round($average / 10); //rank 就是exercises表的times
                //创建user训练计划file, 并获取其路径
                $this->filename =  $this->createfile($_SESSION["UserID"], $targetDir);

                //查询插入exercises表中最大id
                $sql = "SELECT * FROM exercises ORDER BY `exercise_id` DESC LIMIT 1";
                $res = mysqli_query($connID,$sql);
                $data = $res->fetch_all();
                $exercise_id = $data[0][0];
                $exercise_id++;
                //写sql语句 并 插入exercises表中
                $sql = "INSERT INTO exercises (`exercise_id`, `filename`, `start`, `end`, `times`) VALUES ($exercise_id, '{$this->filename}',  '{$start}', '{$end}', $rank)";
                mysqli_query($connID,$sql);
                //将当前exercise_id和user表关联起来
                $sql = "UPDATE `user` SET `exercise_id` = $exercise_id WHERE `user`.`user_id` = {$_SESSION["UserID"]}";
                mysqli_query($connID,$sql);
            }else{
                echo "请提前上传跑步数据!";
            }
        }
        private function createfile($userid, $targetDir){
            // 检查目标目录是否存在，如果不存在则创建它
            if(!is_dir($targetDir)){
                mkdir($targetDir, 0777, true);
            }
            //生成训练文件的待储存信息
            $data = array();
            $filed = array("Erun","CoreStrength","EMrun", "ropejump","Irun", "Trun","Break");
            $w = date("w", $this->start); //获得开始训练那天的星期数
            $date = date('Y-m-d', $this->start);
            for($i=0; $i<30; $i++){
                $data["$date"]["week"] = $w % 7;
                $data["$date"]["exercise"] = $filed[$i%7].".json";
                $w++;
                $date = strtotime("+1 day", strtotime($date));
                $date = date('Y-m-d', $date);
            }

            //把数据数组转换成json格式的字符串
            $json = json_encode($data);
            //设置存储path 并生成对应训练数据文件
            $filename = "publicFile/UserExe/" . $userid . ".json";
            $file = fopen($filename, "w+");
            fwrite($file, $json);
            //关闭文件
            fclose($file);
            return $filename;
        }
        public function showToday($date){

        }
    }
