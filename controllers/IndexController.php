<?php


class IndexController extends Controller
{
    public $testParam = '123';

    public function indexAction()
    {
        //$messageModel = new MessageModel();
        //$messages = $messageModel->getAll();
        //$this->view->messages = $messages;
        // 跳转页面
        $this->render();

        // 直接输出
        //$this->export($messages);

        // 重定向
        //$this->redirect('/');
    }

}