<?php
/**
 * 视图层，把模板加载进来，并展示
 */
class View
{
    //private $variables = [];

    public function __construct() {}

    /** 渲染显示 **/
    public function render($viewPath)
    {
        //extract($this->variables);
        $activeHeaderAnchor = $this->getAnchor($viewPath);
        include (VIEW_PATH . DIRECTORY_SEPARATOR . 'Base/Header.php');
        include ($viewPath);
        include (VIEW_PATH . DIRECTORY_SEPARATOR . 'Base/Footer.php');
    }
    
    private function getAnchor($viewPath)
    {
        if (empty($viewPath)) {
            return 0;
        }
        //VIEW_PATH . DIRECTORY_SEPARATOR . $controllerName . DIRECTORY_SEPARATOR . $actionName . '.php';
        $strSplits = explode(DIRECTORY_SEPARATOR, $viewPath);
        if (count($strSplits) <= 2) {
            return 0;
        }
        $anchor = 0;
        $controllerName =  $strSplits[count($strSplits) - 2];
        switch ($controllerName) {
            case 'Index':
                $anchor = 0;
                break;
            case 'Acticle':
                $anchor = 1;
                break;
            case 'Picture':
                $anchor = 2;
                break;
            case 'Message':
                $anchor = 3;
                break;
            case 'Me':
                $anchor = 4;
                break;
            default:
                $anchor = 0;
        }
        return $anchor;
    }


}