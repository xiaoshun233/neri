<?php //判断是否为登录状态
require_once './../method/token.php';
require_once './../link/public/session.php';
if (isset($_POST['data'])) {
    $userkey = json_decode($_POST['data']);
    require_once './../method/token.php';
    require_once './../method/encrypt.php';
    require_once './../method/getuserip.php';
    $token = getUserIP() . $_SERVER['HTTP_USER_AGENT'];
    $userkey = encrypt($userkey, $token);
    $result = validToken('usertoken', $userkey);
    echo json_encode($result);
}
