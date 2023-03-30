<?php

namespace Controller\Admin;

use Core\Controller;
use Model\UserModel;

class UserController extends Controller
{
    use \Traits\Jump;

    public function loginMethod()
    {
        $msg = '';
        if (!empty($_POST)) {
            $user = $_POST['username'];
            $password = $_POST['pwd'];
            $captcha = new \Lib\Captach();
            if ($captcha->check($_POST['code']) == 0)
                $this->error('index.php?m=login&c=user&p=Admin', '验证码错误');
            if ($user == '' || $password == '') {
                $msg = '请正确输入用户名或密码';
            }
            $userobject = new \Model\UserModel('users');
            $ulist = $userobject->checkUserNameAndPwd($userobject, $user, md5(md5($password . $GLOBALS['config']['app']['dk'])));
            if (!empty($ulist)) {
                $_SESSION['user'] = $user;
                $_SESSION['iconpath'] = $ulist[0]['filepath'];
                $this->success('index.php?m=list&p=Admin&c=Product', '登录成功');
            } else {
                $this->error('index.php?m=login&p=Admin&c=User', '登录失败');
            }
        }
        require __VIEW__ . 'User' . DS . 'login.html';
    }

    public function registerMethod()
    {
        $msg = '';
        $data = array();
        if (!empty($_POST)) {
            $user = $_POST['username'];
            if ($user == '' || $_POST['pwd'] == '' || $_FILES['face'] == '') {
                $msg = '用户名，密码或上传文件不能为空';
            } else {
                $usm = new UserModel('users');
                if ($usm->isExist($usm, array('username' => $user)) == 0) {//存在sql注入的风险
                    $path = $GLOBALS['config']['app']['path'];
                    $size = $GLOBALS['config']['app']['size'];
                    $ftype = $GLOBALS['config']['app']['ftype'];
                    $upload = new \Lib\Upload($path, $size, $ftype);
                    if ($upload->uploadOne($_FILES['face'])) {
                        $finalfilepath = $upload->getuploadfilepath();
                        if (!empty($finalfilepath)) {
                            $img = new \Lib\Image($finalfilepath);
                            $data['filepath'] = $path . '/' . $img->filepath();
                        }
                        $data['pwd'] = md5(md5($_POST['pwd'] . $GLOBALS['config']['app']['dk']));//加入密钥
                        $data['username'] = $user;
                        if ($usm->insert($data) == 1) {
                            $_SESSION['user'] = $user;
                            $this->success('index.php?c=User&m=Login&p=Admin', '注册成功');
                        } else {
                            $this->error('index.php?c=User&m=register&p=Admin', '注册失败');
                        }
                    } else {
                        $this->error('index.php?p=Admin&c=user&m=register', $upload->getError());
                    }
                } else {
                    $msg = '用户名已存在';
                }
            }
        }
        require __VIEW__ . 'User' . DS . 'register.html';
    }

    public function checkUserMethod()
    {
        $model = new \Model\UserModel('users');
        echo $model->isExist($model, array('username' => $_GET['username']));
    }

    public function verifyMethod()
    {
        $captcha = new \Lib\Captach();
        $captcha->entry();
    }

    public function logoutMethod()
    {
        session_destroy();
        header('Location:index.php?m=login&c=user&p=Admin');
    }
}
