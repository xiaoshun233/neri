<?php
require_once "./php/method/token.php";
require_once "./php/link/public/mysql.php";
require_once "./php/method/mysqlPreprocess.php";
try {
    if (!isset($_COOKIE['userkey'])) {
        throw new Exception('请先登录');
    } else {
        $userkey = $_COOKIE['userkey'];
    }

    if (!validToken('usertoken', $userkey)) {
        throw new Exception('登录信息有误');
    }
    $sql = "SELECT signtime,nickname,headshot from users where usertoken = ?";
    $result = mysqlPreprocess($link, $sql, 's', $userkey);
    if (empty($result)) {
        throw new Exception("用户数据为空");
    } else if (count($result) > 1) {
        throw new Exception('数据查询有误');
    } else {
        $userdata = $result[0];
        $result = null;
    }
    date_default_timezone_set('PRC');
    if (empty($userdata['signtime'])) {
        throw new Exception('账号信息有误');
    }
    $signflag = floor((strtotime("now") - strtotime($userdata['signtime'])) / 86400);
    $signflag = $signflag > 0 ? true : false;
} catch (Exception $e) {
    die($e->getMessage());
}
