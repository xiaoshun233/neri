<?php
try {
    $result =  ["result" => "", "status" => false, "msg" => ""];
    if (!isset($_POST['data'])) {
        throw new Exception('No get data in this login post request');
    }
    require_once '../class/User.class.php';
    require_once '../method/getuserip.php';
    $data = json_decode($_POST['data']);
    $user = new User();
    $user->set('username', $data->username);
    $user->set('password', $data->password);
    $data = null;
    if (!($result['result'] = $user->login(getUserIP(), $_SERVER['HTTP_USER_AGENT']))) {
        throw new Exception('登录失败');
    } else {
        $result['status'] = true;
        $result['msg'] = '登陆成功';
    }
} catch (Exception $e) {
    $result['msg'] = $e->getMessage();
} finally {
    echo json_encode($result);
}
