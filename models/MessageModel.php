<?php

/**
 * Author: Administrator
 * Date: 2017/6/7
 * Time: 14:10
 * Description: 留言表
 */
class MessageModel extends Model
{
    // 获取全部 : 此处可抽象化
    public function getAll()
    {
        $queryString = 'select * from message';
        $stmt = $this->dbHandle->prepare($queryString);
        $stmt->execute();
        $rows = $stmt->fetchAll();
        $messageList = [];
        foreach ($rows as $row) {
            $id = $row['id'];
            $userId = $row['userId'];
            $userName = $row['userName'];
            $content = $row['content'];
            $publishDate = $row['publishDate'];
            $message = new MessageObject($id, $userId, $userName, $content, $publishDate);
            $messageList[] = $message;
        }
        return $messageList;
    }
}