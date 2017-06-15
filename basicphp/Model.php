<?php

class Model
{
    protected $_table;

    protected $connection = null;

    function __construct()
    {
        // 连接数据库
        $this->connect(DB_HOST, DB_PORT, DB_NAME, DB_CHARSET, DB_USER, DB_PASSWORD);

        // TODO 获取当前表名用于作一些统一的查询等
        // 获取表名
        $this->_table = strtolower(rtrim(__CLASS__, 'Model'));
    }

    // 连接数据库
    private function connect($host, $port, $charset, $username, $passwd, $dbname)
    {
        if (is_null($this->connection)) {
            try {
                //$dsn = "mysql:host=$host;port=$port;dbname=$dbname";
                //$dbHandle = new PDO($dsn, $username, $passwd);
                //$this->connection = $dbHandle;

                $connection = new PDO('mysql:host=localhost;dbname=winterkid;charset=utf8', 'root', '123456');

                $this->connection = $connection;
            } catch (PDOException $e) {
                exit('error_message: ' . $e->getMessage());
            }
        }
    }

    // 未来用于orm
    private function creatObject(){}

    //region 通用数据库操作
    //endregion
}