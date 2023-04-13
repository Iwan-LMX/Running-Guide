<?php
class Getquotient{
    private $quotient; //跑力值
    private $date;  //跑步执行日期
    private $ability_id;    //本次跑步跑力值id
    private $k =0.48, $h=165;
    public function __construct(){
        require "Config/database.php";
        //获取quotient表内已最后一条数据的id
        $sql = "SELECT * FROM quotient ORDER BY ability_id DESC LIMIT 1";
        $result = mysqli_query($connID,$sql) -> fetch_all();
        $this->ability_id = $result[0][0];
    }
    public function calculate($rundata){
        require "Config/database.php";
        $this->ability_id++;
        $this->date = $rundata["date"];
        //计算跑力值
        $this->quotient = $rundata["average_speed"] * $rundata["distance"];
        if($this->quotient != 0){//考虑系统健壮性
            $this->quotient += 20;
            $this->quotient += $this->k * ($rundata["heart_rate"] - $this->h);
            $this->quotient -= abs($rundata["cadence"] - 180);
        }
        //将跑力值存入数据库
        session_start();
        $sql = "INSERT INTO quotient (ability_id,user_id, date, quotient) VALUES ({$this->ability_id}, {$_SESSION["UserID"]},  {$this->date}, {$this->quotient})";
        mysqli_query($connID,$sql);

        return $this->ability_id;
    }
    public function weekquotients($userid){
        require "Config/database.php";
        //获取quotient表内已最后一条数据的id
        $sql = "SELECT * FROM quotient WHERE user_id = {$userid} ORDER BY `date` DESC LIMIT 7";
        $result = mysqli_query($connID,$sql);
        $num = mysqli_num_rows($result);//函数返回结果集中行的数量
        if($num){
            return $result->fetch_all();
        }else{
            return null;
        }
    }
}