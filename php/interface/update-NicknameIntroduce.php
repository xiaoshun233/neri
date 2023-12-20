<?php
require_once "./../method/checkString.php";
require_once "./../class/User.class.php";
require_once "./../method/checklogin.php";
$result =  ["result" => "", "status" => false, "msg" => ""];
try {
    if (!isset($_POST['data'])) {
        throw new Exception('No get data in this login post request');
    } else {
        $data = json_decode($_POST['data']);
    }
    if (empty($data->nickname)) {
        throw new Exception('昵称数据不能为空');
    }
    if (empty($data->introduce)) {
        throw new Exception('简介数据不能为空');
    }
    if (empty($data->userkey)) {
        throw new Exception('用户密钥不能为空');
    }
    //昵称正则表达式
    $preg = "/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u";
    if (!checkLegitimate($data->nickname, $preg)) {
        throw new Exception('昵称不能包含非法字符');
    }
    if (!checklogin($data->userkey)) {
        throw new Exception('用户信息验证失败');
    }
    $user = new User();
    $user->set('nickname', $data->nickname);
    $user->set('introduce', $data->introduce);
    $user->set('userkey', $data->userkey);
    $result['status'] = $user->updateNicknameIntroudce();
    if ($result['status']) {
        $result['msg'] = "数据更新成功";
    }
} catch (Exception $e) {
    $result['msg'] = $e->getMessage();
} finally {
    echo json_encode($result);
}
