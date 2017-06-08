<?php

class MessageObject extends Object
{
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