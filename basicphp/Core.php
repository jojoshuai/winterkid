<?php
class Core
{
    // 自动加载控制器和模型类
    static function loadClass($class)
    {
    }

    // 路由处理
    function Route()
    {
        $controllerName = 'Index';
        $actionName = 'index';

        // 域名后的请求path_info
        $originalPathInfo = $_SERVER['PATH_INFO'];
        if (!is_null($originalPathInfo)) {
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

        $dispatchInfo['controller'] = $controllerName . 'Controller';
        $dispatchInfo['action'] = $actionName . 'Action';

        if (isset($dispatchInfo['controller'])) {
            if (class_exists($dispatchInfo['controller'])) {
                $controller = new $dispatchInfo['controller']();
            }
            else {
                error_log("Can't load controller:{$dispatchInfo['controller']}");
            }
        }

        if (isset($dispatchInfo['action'])) {
            $func = isset($controller) ? array($controller, $dispatchInfo['action']) : $dispatchInfo['action'];
            if (isset($controller) && !method_exists($controller, $dispatchInfo['action']) && !method_exists($controller,'__call')) {
                if (method_exists($controller, 'display404')) {
                    $controller->display404();
                    return;
                }
            }
            if (!is_callable($func, true)) {
                error_log("Can't dispatch action:{$dispatchInfo['action']}");
            }
            call_user_func($func);
        }
    }
    
    // 运行程序
    function run()
    {
        $this->Route();
    }
}