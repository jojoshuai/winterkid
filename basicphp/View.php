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
        include ($viewPath);
    }


}