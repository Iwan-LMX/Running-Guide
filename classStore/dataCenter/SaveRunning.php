<?php
class SaveRunning{
    private $runnings = array();
    public function __construct($runs){
        $run= array();
        foreach ($runs as $running){
            array_push($this->runnings, $running ["date"],$running ["average_speed"], $running ["distance"], $running ["heart_rate"], $running ["cadence"]);
        }
    }
    public  function Saveruns(){
        require "Config/database.php";
        session_start();
        $username = $_SESSION['Username'];
        $password = $_SESSION['Password'];
        //构造SQL语句
        $value ="";
        foreach ($this->runnings as $running){
            foreach ($running as $item){
                $value = $value . "$item";
            }
            $value = $value . ""
        }

        $sql = "INSERT INTO my_table (name, age, gender) VALUES ('" . $my_array["name"] . "', " . $my_array["age"] . ", '" . $my_array["gender"] . "')";
    }
}