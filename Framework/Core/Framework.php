<?php

class Framework
{
    //初始化常量
    private static function initConst()
    {
        define('DS', DIRECTORY_SEPARATOR);//定义目录分隔符
        define('ROOT_PATH', getcwd() . DS);//入口文件所在的目录
        define('APP_PATH', ROOT_PATH . 'Application' . DS);//application目录
        define('CONFIG_PATH', APP_PATH . 'Config' . DS);//Config目录
        define('CONTROLLER_PATH', APP_PATH . 'Controller' . DS);//Controller目录
        define('MODEL_PATH', APP_PATH . 'Model' . DS);//Model目录
        define('VIEW_PATH', APP_PATH . 'View' . DS);//View目录
        define('FRAMEWORK_PATH', ROOT_PATH . 'Framework' . DS);//Framework目录
        define('CORE_PATH', FRAMEWORK_PATH . 'Core' . DS);//Core目录
        define('LIB_PATH', FRAMEWORK_PATH . 'Lib' . DS);//Lib目录
        define('TRAIT_PATH', ROOT_PATH . 'Traits' . DS);//Traits
    }

    //引入配置文件
    private static function initConfig()
    {
        $GLOBALS['config'] = require CONFIG_PATH . 'config.php';
    }

    //确定路由
    private static function initRoutes()
    {
        $p = isset($_GET['p']) ? $_GET['p'] : $GLOBALS['config']['app']['dp'];
        $c = isset($_GET['c']) ? $_GET['c'] : $GLOBALS['config']['app']['dc'];
        $m = isset($_GET['m']) ? $_GET['m'] : $GLOBALS['config']['app']['dm'];
        $p = ucfirst(strtolower($p));
        $c = ucfirst(strtolower($c));//首字母大写
        $m = strtolower($m);//转成小写
        define('PLATFORM_NAME', $p);//平台名常量
        define('CONTROLLER_NAME', $c);//控制器名常量
        define('METHOD_NAME', $m);//方法名常量
        define('__URL__', CONTROLLER_PATH . $p . DS);//当前请求的控制器地址
        define('__VIEW__', VIEW_PATH . $p . DS);//当前视图的目录地址
    }

    //自动加载
    private static function initAutoLoad()
    {
        spl_autoload_register(function ($class_name) {
            $namespace = dirname($class_name);//命名空间
            $class_name = basename($class_name);//类名
            if (in_array($namespace, array('Core', 'Lib')))
                $path = FRAMEWORK_PATH . $namespace . DS . $class_name . '.php';
            elseif ($namespace == 'Model')
                $path = MODEL_PATH . $class_name . '.php';
            elseif ($namespace == 'Traits')
                $path = TRAIT_PATH . $class_name . '.php';
            else
                $path = __URL__ . $class_name . '.php';
            if (is_file($path) && file_exists($path))
                require $path;
        });
    }

    //请求分发
    private static function initDispatch()
    {
        $controller_name = DS . 'Controller' . DS . PLATFORM_NAME . DS . CONTROLLER_NAME . 'Controller';//拼接控制器
        $method_name = METHOD_NAME . 'Method';
        $obj = new $controller_name();
        $obj->$method_name();
    }

    public static function run()
    {
        self::initConst();
        self::initConfig();
        self::initRoutes();
        self::initAutoLoad();
        self::initDispatch();
    }
}
