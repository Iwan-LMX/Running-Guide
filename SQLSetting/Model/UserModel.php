<?php

namespace Model;


class UserModel extends \Core\Model
{
    public function isExist($userobject, $cond = array())
    {
        if ($userobject->select($cond)) {
            $flag = 1;
        } else {
            $flag = 0;
        }
        return $flag;
    }

    public function checkUserNameAndPwd($userobject, $username, $passwd)
    {
        return $userobject->select(array('username' => $username, 'pwd' => $passwd));
    }

    public function getusericonMethod()
    {
        $user = new UserModel('users');
        $ulist = $user->select(array('username' => $_SESSION['user']));
        return $ulist;
    }
}
