<?php

namespace Traits;
trait Jump
{
    //封装成功的跳转
    public function success($url, $info)
    {
        $this->redirect($url, $info, 2, 'success');
    }

    //封装失败的跳转
    public function error($url, $info, $time = 4)
    {
        $this->redirect($url, $info, $time, 'error');

    }

    /*
     * 作用跳转的方法
     * @parma $url string 跳转的地址
     * @parma $info string 显示信息
     * @parma $time int 停留时间
     * @parma $flag string 显示模式
     */
    private function redirect($url, $info, $time, $flag)
    {
        if ($info == '')
            header("Location:{$url}");
        else
            require __VIEW__ . 'common.html';
    }

}
