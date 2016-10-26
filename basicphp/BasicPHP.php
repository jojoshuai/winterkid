<?php
// 根目录
defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__));
// 框架目录
defined('FRAME_PATH') || define('FRAME_PATH', __DIR__);
// 配置目录
defined('CONFIG_PATH') || define('CONFIG_PATH', ROOT_PATH. '/config');
// 模型目录
defined('MODEL_PATH') || define('MODEL_PATH', ROOT_PATH. '/models');
// 控制器目录
defined('CONTROLLER_PATH') || define('CONTROLLER_PATH', ROOT_PATH. '/controllers');
// 视图目录
defined('VIEW_PATH') || define('VIEW_PATH', ROOT_PATH. '/views');

//包含核心框架类
require FRAME_PATH . '/Core.php';

// 实例化核心类
$fast = new Core;
$fast->run();