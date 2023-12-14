<?php
require_once './../link/public/mysql.php';
require_once './../class/Article.class.php';
require_once './../method/checklogin.php';
require_once './../method/mysqlPreprocess.php';
try {
    $result = ["result" => "", "status" => false, "msg" => ""];
    if (!isset($_POST['data'])) {
        throw new Exception('No get data in this register post request');
    }
    $data = json_decode($_POST['data']);
    if (empty($data->title)) {
        throw new Exception('title is null');
    }
    if (empty($data->cover)) {
        throw new Exception('cover is null');
    }
    if (empty($data->type)) {
        throw new Exception('type is null');
    }
    if (empty($data->about)) {
        throw new Exception('about is null');
    }
    if (empty($data->baidu) && empty($data->od)) {
        throw new Exception('baidu and od is downlink is null');
    }
    if (empty($data->outlinks)) {
        throw new Exception('outlinks is null');
    }
    if (empty($data->about_imgs)) {
        throw new Exception('about_imgs is null');
    }
    if (empty($data->userkey)) {
        throw new Exception('userkey is null');
    }

    if (!checklogin($data->userkey)) {
        throw new Exception('userkey and token is not equal');
    }

    $sql = "SELECT username 
            from users 
            where usertoken = ?";
    $author = mysqlPreprocess($link, $sql, 's', getToken('usertoken'))[0]['username'];

    $article = new Article();
    $article->setAll(
        $data->title,
        $data->cover,
        $author,
        $data->type,
        $data->about,
        $data->baidu,
        $data->od,
        $data->outlinks,
        $data->about_imgs
    );
    unset($data);
    $result['status'] = $article->Contributearticles();
} catch (Exception $e) {
    $result['msg'] = $e->getMessage();
} finally {
    echo json_encode($result);
}
