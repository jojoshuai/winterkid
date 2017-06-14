<?php


class IndexController extends Controller
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

        $ip = $this->getIp();
        $this->view->ip = $ip;
        //$this->view->city = $this->getCityByIp($ip);
        // 跳转页面
        $this->render();
    }

    private function getIp()
    {
        $ip = null;
        if (isset($_SERVER)) {
            if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ipArray = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                $ip = trim($ipArray[0]);
            }
            else if (isset($_SERVER['HTTP_CLIENT_IP'])) {
                $ip = trim($_SERVER['HTTP_CLIENT_IP']);
            }
            else if (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
        }
        else {
            $resIp = null;
            if (getenv("HTTP_X_FORWARDED_FOR")){
                $resIp = getenv("HTTP_X_FORWARDED_FOR");
            } else if (getenv("HTTP_CLIENT_IP")) {
                $resIp = getenv("HTTP_CLIENT_IP");
            } else {
                $resIp = getenv("REMOTE_ADDR");
            }
            if ($resIp != null) {
                $ipArray = explode(',', $resIp);
                $ip = $ipArray[0];
            }
        }
        return $ip;
    }

    // 此调用很慢，考虑替换或删除
    private function getCityByIp($ip)
    {
        $city = 'unknown';
        $url = 'http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip;
        $result = file_get_contents($url);
        $result = json_decode($result, true);
        if($result['code'] == 0 && is_array($result['data'])){
            $city = $result['data']['city'];
        }
        return $city;
    }
}