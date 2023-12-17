<?php
require_once './../class/Article.class.php';
$result = ["result" => "", "status" => false, "msg" => ""];
try {
    if (!isset($_POST['data'])) {
        throw new Exception('no data');
    }
    $data = json_decode($_POST['data']);
    if (empty($data->number)) {
        throw new Exception('number can not empty');
    }
    if (empty($data->comment)) {
        throw new Exception('content can not empty');
    }
    if (empty($data->userkey)) {
        throw new Exception('userkey can not empty');
    }
    if (!($number = intval($data->number))) {
        throw new Exception('number can not is zero');
    }

    $article = new Article();
    $article->setvar('number', $number);
    $result['status'] = $article->pulishcomment($data->userkey, $data->comment);
    if ($result) {
        $result['msg'] = "评论成功";
    }
} catch (Exception $e) {
    $result['msg'] = $e->getMessage();
} finally {
    echo json_encode($result);
}
