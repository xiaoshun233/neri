<?php
require_once './../class/User.class.php';
$result = ["result" => "", "status" => false, "msg" => ""];
try {
    if (!isset($_POST['data'])) {
        throw new Exception('no data');
    }
    $data = json_decode($_POST['data']);
    if (empty($data->collectionid)) {
        throw new Exception('collectionid is empty');
    }
    if (empty($data->userkey)) {
        throw new Exception('user is empty');
    }
    if (!($number = intval($data->collectionid))) {
        throw new Exception('number can not is zero');
    }
    $user = new User();
    $user->getusernumber($data->userkey);
    $checkdelete = $user->deleteCollection($number);
    if (!$checkdelete) {
        throw new Exception('delete collection fail');
    }
    $result['status'] = true;
    $result['msg'] = 'success';
} catch (Exception $e) {
    $result = false;
} finally {
    echo json_encode($result);
}
