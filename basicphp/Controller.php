<?php
/**
 * 控制器基类
 */
class Controller
{
    private $_view;

    private static $entity = null;

    // 构造函数，初始化属性，并实例化对应模型
    function __construct()
    {
    }

    public function view()
    {
        // controllername
        if (is_null($this->_view)) {
            $this->_view = new View();
        }
        return $this->_view;
    }

    // 获取get参数
    public function get($key, $option=[])
    {
        if (null === $key) {
            return null;
        }
        $value = null;
        $allowNull = isset($option['allow_null']) ? $option['allow_null'] : false;
        $default = isset($option['default']) ? $option['default'] : null;
        $type = isset($option['type']) ? $option['type'] : null;
        $filterOptions = isset($option['filter_options']) ? $option['filter_options'] : [];
        if (isset($_GET[$key])) {
            $value = $_GET[$key];
            $value = $this->typeMatch($value, $type, $filterOptions);
            if (!$value) {
                // todo by zs 转化失败则 跳转到对应的报错页面 并打印"输入参数非期望类型"
            }
        }
        else if ($allowNull){
            $value = $default;
        }
        else {
            // todo by zs 没有获取到参数，跳转到报错页面，并打印 缺少期望的参数
        }
        return $value;
    }

    // 获取post参数
    public function post($key, $option=[])
    {
        if (null === $key) {
            return null;
        }
        $value = null;
        $allowNull = isset($option['allow_null']) ? $option['allow_null'] : false;
        $default = isset($option['default']) ? $option['default'] : null;
        $type = isset($option['type']) ? $option['type'] : null;
        $filterOptions = isset($option['filter_options']) ? $option['filter_options'] : null;
        $value = $this->getPostValue($key);
        if ($value) {
            $value = $this->typeMatch($value, $type, $filterOptions);
            if (!$value) {
                // todo by zs 转化失败则 跳转到对应的报错页面 并打印"输入参数非期望类型"
            }
        }
        else if ($allowNull){
            $value = $default;
        }
        else {
            // todo by zs 没有获取到参数，跳转到报错页面，并打印 缺少期望的参数
        }
        return $value;
    }

    private function getHttpEntity()
    {
        if (is_null(self::$entity)) {
            self::$entity = file_get_contents('php://input');
        }
        return self::$entity;
    }

    private function getPostValue($key)
    {
        $value = null;
        $value = isset($_POST[$key]) ? $_POST[$key] : null;
        return $value;

        //
        ////获取header中Content-Type | php://input 取不到 content-type为multipart/form-data的值
        //$contentType = isset($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : null;
        //$contentTypes = explode($contentType, ';');
        //
        //if ($contentTypes[0] == "multipart/form-data") {
        //
        //}
        //else if ($contentTypes[0] == "multipart/form-data"){
        //    //
        //    $entityBody = $this->getHttpEntity();
        //
        //}
    }

    //todo 此处可扩展自定义的过滤器
    private function typeMatch($value, $type, $filterOptions = null)
    {
        $matchResult = true;
        if (!is_null($type)){
            $matchResult = filter_var($value, $type, $filterOptions);
        }
        return $matchResult;
    }
    
    // 显示默认页面
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

    // XHR 成功输出模板
    protected function successTemplate($data=[])
    {
        return [
            'data' => $data,
            'error_code' => 0,
            'message' => '',
            'success' => true
        ];
    }

    // XHR 失败输出模板
    protected function failTemplate($message = 'fail', $error_code = 100, $action=null)
    {
        return [
            'error_code' => $error_code,
            'message' => $message,
            'success' => false,
            'action' => $action
        ];
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