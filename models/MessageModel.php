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
        $connection = $this->connection->prepare($queryString);
        $connection->execute();
        $rows = $connection->fetchAll();
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
    
    public function create($content, $userId=404, $userName='noname')
    {
        $queryString = "insert into message(userId, userName, content) values({$userId}, {$userName}, {$content})";
        $connection = $this->connection;
        $connection->beginTransaction();
        $connection->exec($queryString);
        $res = $connection->commit();
        return $res;
    }

    public function createMulti($messageInfoList)
    {
        $connection = $this->connection;
        $stmt = $connection->prepare("insert into message(userId, userName, content) values(:userId, :userName, :content)");
        foreach ($messageInfoList as $messageInfo) {
            $stmt->bindParam(':useId', $messageInfo['userId']);
            $stmt->bindParam(':userName', $messageInfo['userName']);
            $stmt->bindParam(':content', $messageInfo['content']);
            $res = $stmt->execute();
        }
        return true;
    }
}