<?php
namespace Core\dept;

class Dept{
    private $module;
    private $model;
    private $action;

    public function __construct()
    {
        $path_info = isset($_SERVER['PATH_INFO'])?$_SERVER['PATH_INFO']:''; //apache兼容
        $path_info = (isset($_SERVER['REQUEST_URI']) && empty($path_info))?$_SERVER['REQUEST_URI']:''; //apache未启用pathinfo
        echo $_SERVER['REQUEST_URI'];
        if($path_info!='')
        {
            $path_arr = explode('/',$path_info);
            $module = empty($path_arr[1])?'home':$path_arr[1];
            $model = empty($path_arr[2])?'Index':$path_arr[2];
            $action = empty($path_arr[3])?'index':$path_arr[3];

            $path_num = count($path_arr);
            if($path_num>4)
            {
                for($i=4;$i<$path_num;$i++)
                {
                    $_GET[$path_arr[$i]] = $path_arr[$i+1];
                }
            }
        }
        else
        {
            $module = 'home';
            $model = 'Index';
            $action = 'index';
        }

        $class_name = "\App\Controll\\{$module}\\{$model}";
        $class_obj = new $class_name();
        $class_obj->$action();
    }
}
?>