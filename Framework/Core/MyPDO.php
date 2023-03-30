<?php

namespace Core;
class MyPDO
{
    private static $instance;
    private $host;//主机
    private $port;//数据库端口号
    private $dbname;//数据库名
    private $charset;//数据库字符编码集
    private $user;//数据库用户名
    private $pwd;//密码
    private $dbtype;//数据库类型
    private $dns;
    private $mypdo;

    private function __construct($parma)
    {
        $this->initParma($parma);
        $this->initPDO();
        $this->initException();
    }

    private function __clone()
    {
    }

    //返回创建对象
    public static function getInstance($parma)
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self($parma);
        }
        return self::$instance;
    }

    //初始化参数
    private function initParma($parma)
    {
        $this->host = $parma['host'];
        $this->port = $parma['port'];
        $this->dbname = $parma['dbname'];
        $this->charset = $parma['charset'];
        $this->user = $parma['user'];
        $this->pwd = $parma['pwd'];
        $this->dbtype = $parma['dbtype'];
    }

    //初始化PDO
    private function initPDO()
    {
        try {
            $this->dns = "{$this->dbtype}:host={$this->host};port={$this->port};dbname={$this->dbname};charset={$this->charset}";
            $this->mypdo = new \PDO($this->dns, $this->user, $this->pwd);
        } catch (\PDOException $ex) {
            $this->showException($ex);
        }
    }

    //初始化异常
    private function initException()
    {
        $this->mypdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    //执行增删改
    public function exec($sql)
    {
        try {
            return $this->mypdo->exec($sql);
        } catch (\PDOException $ex) {
            $this->showException($ex, $sql);
        }
    }

    //返回最后一次插入的id
    public function lastinsertnum()
    {
        return $this->mypdo - lastInsertId();
    }

    //返回二维数组
    public function fetchAll($sql, $type = '')
    {
        try {
            $rs = $this->mypdo->query($sql);
            $type = $this->getType($type);;
            return $rs->fetchAll($type);

        } catch (\PDOException $ex) {
            $this->showException($ex, $sql);
        }
    }

    //返回一维数组
    public function fetchRow($sql, $type = '')
    {
        try {
            $rs = $this->mypdo->query($sql);
            $type = $this->getType($type);
            $rs->fetch($type);
        } catch (\PDOException $ex) {
            $this->showException($ex, $sql);
        }
    }

    //获取一行一列
    public function fetchColumn($sql)
    {
        try {
            $stmt = $this->mypdo->query($sql);
            return $stmt->fetchColumn();
        } catch (\PDOException $ex) {
            $this->showException($ex, $sql);
        }
    }

    //匹配数据的类型
    private function getType($type)
    {
        switch ($type) {
            case 'num':
                return \PDO::FETCH_NUM;
            case 'obj':
                return \PDO::FETCH_OBJ;
            case 'both':
                return \PDO::FETCH_BOTH;
            default:
                return \PDO::FETCH_ASSOC;
        }
    }

    //显示异常
    private function showException($ex, $sql = '')
    {
        if ($sql != '') {
            echo 'SQL语句执行失败<br>';
            echo '错误的SQL语句为' . $sql . '<br>';
        }
        echo '错误编号为：' . $ex->getCode() . '<br>';
        echo '错误行号为：' . $ex->getLine() . '<br>';
        echo '错误信息为：' . $ex->getMessage() . '<br>';
        echo '错误文件为：' . $ex->getFile() . '<br>';
    }
}
