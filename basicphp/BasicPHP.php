<?php
// 根目录
defined('ROOT_PATH') || define('ROOT_PATH', dirname(__DIR__));
// 框架目录
defined('FRAME_PATH') || define('FRAME_PATH', __DIR__);
// 配置目录
defined('CONFIG_PATH') || define('CONFIG_PATH', ROOT_PATH. DIRECTORY_SEPARATOR . 'config');
// 模型目录
defined('MODEL_PATH') || define('MODEL_PATH', ROOT_PATH. DIRECTORY_SEPARATOR . 'models');
// 控制器目录
defined('CONTROLLER_PATH') || define('CONTROLLER_PATH', ROOT_PATH. DIRECTORY_SEPARATOR . 'controllers');
// 对象目录
defined('OBJECT_PATH') || define('OBJECT_PATH', ROOT_PATH. DIRECTORY_SEPARATOR . 'objects');
// 视图目录
defined('VIEW_PATH') || define('VIEW_PATH', ROOT_PATH. DIRECTORY_SEPARATOR . 'views');

define('DB_HOST', '115.28.209.115');
define('DB_PORT', '3306');
define('DB_NAME', 'winterkid');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', 'password');


//包含核心框架类
require FRAME_PATH . DIRECTORY_SEPARATOR . 'Core.php';

// 实例化核心类
$fast = new Core;
$fast->run();