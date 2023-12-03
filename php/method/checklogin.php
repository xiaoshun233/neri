<?php //判断是否为登录状态
function checklogin($userkey){
    require_once './../method/token.php';
    $result = validToken('usertoken',$userkey);
    return $result;
}
?>