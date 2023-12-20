<?php
require_once './../method/checklogin.php';
require_once './../class/User.class.php';
$result = ["result" => "", "status" => false, "msg" => ""];
try {
    if (!isset($_POST['data'])) {
        throw new Exception('No get data in this register post request');
    }
    $data = json_decode($_POST['data']);
    if (empty($data->userkey)) {
        throw new Exception('userkey is null');
    }
    if (!checklogin($data->userkey)) {
        throw new Exception('userkey and token is not equal');
    }
    $user = new User();
    $user->getusernumber($data->userkey);
    $result['result'] = $user->usercontribute();
    $result['status'] = true;
    $result['msg'] = 'success';
} catch (Exception $e) {
    $result['msg'] = $e->getMessage();
} finally {
    echo json_encode($result);
}
