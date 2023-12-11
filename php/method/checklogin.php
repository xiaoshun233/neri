<?php //判断是否为登录状态
function checklogin($userkey)
{
    require_once './../method/token.php';
    require_once './../method/encrypt.php';
    require_once './../method/getuserip.php';
    $token = getUserIP() . $_SERVER['HTTP_USER_AGENT'];
    $userkey = encrypt($userkey, $token);
    $result = validToken('usertoken', $userkey);
    return $result;
}
