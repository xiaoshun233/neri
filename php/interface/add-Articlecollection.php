<?php
require_once './../class/Article.class.php';
require_once './../method/checklogin.php';
$result = ["result" => "", "status" => false, "msg" => ""];
try {
    if (!isset($_POST['data'])) {
        throw new Exception('no data');
    }
    $data = json_decode($_POST['data']);
    if (empty($data->number)) {
        throw new Exception('number is empty');
    }
    if (empty($data->userkey)) {
        throw new Exception('user is empty');
    }
    if (!checklogin($data->userkey)) {
        throw new Exception('user is not login');
    }
    if (!($number = intval($data->number))) {
        throw new Exception('number can not is zero');
    }
    $article = new Article();
    $article->setvar('number', $number);
    $status  = $article->addCollection($data->userkey);
    if (is_string($status)) {
        throw new Exception($status);
    } else {
        $result['status'] = true;
        $result['msg'] = "收藏成功";
    }
} catch (Exception $e) {
    $result['msg'] = $e->getMessage();
} finally {
    echo json_encode($result);
}
