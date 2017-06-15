<?php


class MessageController extends Controller
{
    // 首页列表页
    public function indexAction()
    {
        $messageModel = new MessageModel();
        $messages = $messageModel->getAll();
        $this->view->messages = $messages;
        // 跳转页面
        $this->render();

        // 直接输出
        //$this->export($messages);

        // 重定向
        //$this->redirect('/');
    }

    // 留言接口
    public function leaveMessageAction()
    {
        $userId = $this->post('userId', ['allow_null'=>false, 'type'=>FILTER_VALIDATE_INT]);
        $userName = $this->post('userName', ['allow_null'=>false]);
        $content = $this->post('content', ['allow_null'=>false]);
        $messageModel = new MessageModel();
        $isSuc = $messageModel->create($content, $userName, $userId);
        $result = $isSuc ? $this->successTemplate() : $this->failTemplate('留言失败');
        $this->export($result);
    }
}