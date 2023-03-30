<?php

namespace Lib;
class Session
{
    private $mypdo;

    public function __construct()
    {
        session_set_save_handler(
            array($this, 'open'),
            array($this, 'close'),
            array($this, 'read'),
            array($this, 'write'),
            array($this, 'destory'),
            array($this, 'gc')
        );
        session_start();
    }

    public function open()
    {
        $this->mypdo = \Core\MyPDO::getInstance($GLOBALS['config']['database']);
        return true;
    }

    public function close()
    {
        return true;
    }

    //读取会话
    public function read($sess_id)
    {
        $sql = "select sess_value from sess where sess_id='{$sess_id}'";
        return (string)$this->mypdo->fetchColumn($sql);
    }

    //写入会话
    public function write($sess_id, $sess_value)
    {
        $sql = "insert into sess values('{$sess_id}','{$sess_value}',UNIX_TIMESTAMP()) on duplicate key
    update sess_value='{$sess_value}',sess_time=UNIX_TIMESTAMP()";
        return $this->mypdo->exec($sql) !== false;
    }

    //销毁会话
    public function destory($seess_id)
    {
        $sql = "delete from sess where sess_id='{$seess_id}'";
        return $this->mypdo->exec($sql) !== false;
    }

    public function gc($lifetime)
    {
        $expires = time();
        $sql = "delete from sess where sess_time<{$expires}";
        return $this->mypdo->exec($sql) !== false;
    }
}
