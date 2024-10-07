<?php
require_once "classStore/dataCenter/Getquotient.php";
class SaveRunning{
    private $runnings = array();
    public function __construct($runs){
        foreach ($runs as $run){
            $running = array(
                "date"  => "'".$run["date"]."'",
                "average_speed"  => $run["average_speed"],
                "distance"  => $run["distance"],
                "heart_rate"  => $run["heart_rate"],
                "cadence" => $run["cadence"],
            );
            array_push($this->runnings, $running);
        }
    }
    public  function Saveruns(){
        require "Config/database.php";
        $getability = new Getquotient();
        session_start();
        //获取quotient表内已最后一条数据的id
        $sql = "SELECT * FROM runing ORDER BY run_id DESC LIMIT 1";
        $result = mysqli_query($connID,$sql) -> fetch_all();
        $runid = $result[0][0];
        //构造SQL语句 循环插入每一组rundata
        foreach ($this->runnings as $running){
            $value = "" . ++$runid;
            foreach ($running as $item){
                $value = $value . "," . $item;
            }
            $value = $value . "," . $_SESSION["UserID"];
            //计算这一组的跑力值
            $quotientid = $getability->calculate($running);
            $value = $value . "," . $quotientid;
            //插入数据库
            $sql = "INSERT INTO runing (run_id, rundate, speed, distance, heartrate, cadence, user_id, ability_id) VALUES ({$value})";
            mysqli_query($connID,$sql);
        }
    }
}