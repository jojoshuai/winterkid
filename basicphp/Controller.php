<?php
/**
 * 控制器基类
 */
class Controller
{
    private $_view;

    // 构造函数，初始化属性，并实例化对应模型
    function __construct()
    {}

    
    public function view()
    {
        // controllername
        if (is_null($this->_view)) {
            $this->_view = new View();
        }
        return $this->_view;
    }

    public function render()
    {
        $pathInfo = Core::getPathInfo();
        $controllerName = $pathInfo['controller'];
        $actionName = $pathInfo['action'];
        $viewPath = VIEW_PATH . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $actionName . '.php';
        $this->view->render($viewPath);
    }

    // 重定向
    public function redirect($url)
    {
        header("Location:$url", true, 302);
    }

    // 直接输出
    public function export($data)
    {
        //ob_start();
        echo json_encode($data);
        ob_flush();
    }

    public function __get($name)
    {
        $value = null;
        if ($name == 'view') {
            $value = $this->view();
        }
        return $value;
    }

    public function __call($method, $args)
    {
        // 找不到方法就报错误日志
    }
}