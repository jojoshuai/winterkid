<?php

class MessageObject extends Object
{
    /*
         CREATE TABLE `message` (
        `id` int(8) NOT NULL AUTO_INCREMENT,
        `userId` int(8) NOT NULL,
        `userName` varchar(32) NOT NULL,
        `content` text,
        `publishDate` datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
     */

    private $id;
    private $userId;
    private $userName;
    private $content;
    private $publishDate;

    public function __construct($id, $userId, $userName, $content, $publishDate)
    {
        $this->id = $id;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->content = $content;
        $this->publishDate = $publishDate;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getPublishDate()
    {
        return $this->publishDate;
    }

    public function jsonSerialize()
    {
        $all = [];
        foreach ($this as $key => $value) {
            $all[$key] = $value;
        }
        return $all;
    }

    public function __toString()
    {
        return __CLASS__ . ' : ' . $this->id;
    }
}