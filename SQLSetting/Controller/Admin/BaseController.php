<?php

namespace SQLSetting\Controller\Admin;


class BaseController extends \Core\Controller
{
    use \Traits\Jump;

    public function __construct()
    {
        parent::__construct();
        $this->checkLogin();
    }

    private function checkLogin()
    {//验证是否登录
        if (empty($_SESSION['user'])) {
            $this->error('index.php?m=login&c=user', '请登录', 2);
        }
    }
}
