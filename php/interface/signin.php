<?php
require_once './../method/checklogin.php';
require_once './../class/User.class.php';
$result =  ["result" => "", "status" => false, "msg" => ""];
try {
    if (!isset($_POST['data'])) {
        throw new Exception('No get data in this login post request');
    } else {
        $userkey = json_decode($_POST['data']);
    }
    $userstate = checklogin($userkey);
    if (!$userstate) {
        throw new Exception('No logining');
    }
    $user = new User();
    $user->set('usertoken', getToken('usertoken'));
    $signstatus = $user->checksignin();
    if (!$signstatus) {
        throw new Exception('user sign in is error');
    }
    $addprice = $user->addprice();
    if (!$addprice) {
        throw new Exception('user add price is error');
    }
    $result['status'] = true;
    $result['msg'] = '签到成功';
} catch (Exception $e) {
    $result['msg'] = $e->getMessage();
} finally {
    echo json_encode($result);
}
