<?php

namespace Core;
class Model
{
    protected $mypdo;
    private $table;//表名
    private $pk;//主键

    public function __construct($tabe = '')
    {
        $this->initMyPDO();
        $this->initTable($tabe);
        $this->getPrimaryKey();
    }

    protected function initMyPDO()
    {
        $this->mypdo = MyPDO::getInstance($GLOBALS['config']['database']);
    }

    private function initTable($table)
    {
        if ($table != '') {
            $this->table = $table;
        } else { //实例化子类模型
            $this->table = substr(basename(get_class($this)), 0, -5);
        }
    }

    //获取主键
    private function getPrimaryKey()
    {
        $rs = $this->mypdo->fetchAll("desc `{$this->table}`");
        foreach ($rs as $rows) {
            if ($rows['Key'] == 'PRI') {
                $this->pk = $rows['Field'];
                break;
            }
        }
    }

    //万能的插入语句
    public function insert($data)
    {
        $keys = array_keys($data);
        $keys = array_map(function ($k) {
            return "`{$k}`";
        }, $keys);
        $keys = implode(',', $keys);
        $values = implode(',', array_map(function ($v) {
            return "'{$v}'";
        }, array_values($data)));
        $sql = "insert into `{$this->table}` ({$keys}) values ({$values})";
        return $this->mypdo->exec($sql);
    }

    //万能的修改语句
    public function update($data)
    {
        $keys = array_keys($data);
        $index = array_search($this->pk, $keys);
        unset($keys[$index]);
        $keys = implode(',', array_map(function ($k) use ($data) {
            return "`{$k}`='{$data[$k]}'";
        }, $keys));
        $sql = "update `{$this->table}` set {$keys} where `{$this->pk}`='{$data[$this->pk]}'";
        return $this->mypdo->exec($sql);
    }

    //万能的删除
    public function delete($id)
    {
        $sql = "delete from `{$this->table}` where `{$this->pk}`='{$id}'";
        return $this->mypdo->exec($sql);
    }

    //万能的查询语句
    public function select($cond = array())
    {
        $sql = "select * from `{$this->table}` where 1";
        if (!empty($cond)) {
            foreach ($cond as $k => $v) {
                if (is_array($v)) {
                    switch ($v[0]) {
                        case 'eq':
                            $op = '=';
                            break;
                        case 'lt':
                            $op = '<';
                            break;
                        case 'gt':
                            $op = '>';
                            break;
                        case 'lte':
                        case 'elt':
                            $op = '<=';
                            break;
                        case 'gte':
                        case 'egt':
                            $op = '>=';
                            break;
                        case 'neq':
                            $op = '<>';
                            break;
                    }
                    $sql .= " and `{$k}`{$op}'{$v[1]}'";
                } else {
                    $sql .= " and `{$k}`='{$v}'";
                }
            }
        }
        return $this->mypdo->fetchAll($sql);
    }

    //查询返回一维数组
    public function find($id)
    {
        $sql = "select * from `{$this->table}` where `{$this->pk}`='{$id}'";
        return $this->mypdo->fetchRow($sql);
    }
}
