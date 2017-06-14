<?php


class ArticleController extends Controller
{
    //public function indexAction()
    //{
    //    //$messageModel = new MessageModel();
    //    //$messages = $messageModel->getAll();
    //    //$this->view->messages = $messages;
    //    // 跳转页面
    //    $this->render();
    //
    //    // 直接输出
    //    //$this->export($messages);
    //
    //    // 重定向
    //    //$this->redirect('/');
    //}

    public function indexAction()
    {
        $this->render();
    }
}