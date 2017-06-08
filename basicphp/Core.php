<?php

class Core
{
    // 路由处理
    public function Route()
    {
        $dispatchInfo = $this->getPathInfo();
        $controllerName = $dispatchInfo['controller'] . 'Controller';
        $actionName = $dispatchInfo['action'] . 'Action';

        $controller = null;
        if (class_exists($controllerName)) {
            $controller = new $controllerName();
        }
        else {
            error_log("Can't load controller:{$controllerName}");
        }

        $func = is_null($controller) ? $actionName : array($controller, $actionName);
        if (!is_null($controller) && !method_exists($controller, $actionName) && !method_exists($controller, '__call')) {
            if (method_exists($controller, 'render404')) {
                $controller->render404();
                return;
            }
        }
        if (!is_callable($func, true)) {
            error_log("Can't dispatch action:{$actionName}");
        }
        
        call_user_func($func);
    }

    // 获取请求的路径
    public static function getPathInfo()
    {
        $controllerName = 'Index';
        $actionName = 'index';

        // 域名后的请求path_info
        $originalPathInfo = $_SERVER['PATH_INFO'];
        if (!empty($originalPathInfo)) {
            $pathInfoString = trim($originalPathInfo, '/');
            $pathInfo = explode('/', $pathInfoString);
            // 获取controller名
            if (isset($pathInfo[0])) {
                $controllerName = ucfirst($pathInfo[0]);
            }
            // 获取action名
            if (isset($pathInfo[1])) {
                $actionName = $pathInfo[1];
            }
        }

        $dispatchInfo['controller'] = $controllerName;
        $dispatchInfo['action'] = $actionName;
        return $dispatchInfo;
    }

    // 自动加载控制器和模型类
    public static function loadClass($className)
    {
        $classFile = '';

        // 若以Basic开头则为框架类
        if (in_array($className, ['Controller', 'View', 'Model', 'Object'])) {
            $classFile  = FRAME_PATH . DIRECTORY_SEPARATOR . $className . '.php';
        }
        else if (substr($className, -10) == 'Controller') {
            $classFile = CONTROLLER_PATH . DIRECTORY_SEPARATOR . $className . '.php';
        }
        else if (substr($className, -5) == 'Model') {
            $classFile = MODEL_PATH  . DIRECTORY_SEPARATOR . $className . '.php';
        }
        else if (substr($className, -4) == 'View') {
            $classFile = VIEW_PATH  . DIRECTORY_SEPARATOR . $className . '.php';
        }
        else if (substr($className , -6) == 'Object') {
            $classFile = OBJECT_PATH . DIRECTORY_SEPARATOR . $className . '.php';
        }

        if (file_exists($classFile)) {
            include_once $classFile;
        }

        return (class_exists($className, false) || interface_exists($className, false));
    }

    // 运行程序
    public function run()
    {
        spl_autoload_register([$this, 'loadClass']);
        $this->Route();
    }
}