<?php
require_once "./../method/checkString.php";
require_once "./../method/mysqlPreprocess.php";
require_once "./../link/public/mysql.php";
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
    if (empty($data->introcude)) {
        throw new Exception('简介数据不能为空');
    }
    //昵称正则表达式
    $preg = "/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]+$/u";
    if (!checkLegitimate($data->nickname, $preg)) {
        throw new Exception('昵称不能包含非法字符');
    }


    $sql = "UPDATE users SET nickname = ?,introduce = ? WHERE username = ?";
    $result['result'] = mysqlPreprocess($link, $sql, 'sss', $data->nickname, $data->introcude);
} catch (Exception $e) {
    $result['msg'] = $e->getMessage();
} finally {
    echo json_encode($result);
}
