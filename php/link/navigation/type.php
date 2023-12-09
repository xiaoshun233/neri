<?php
require_once './php/method/mysqlPreprocess.php';

if (isset($_GET['s'])) {
    $title = "搜索";
    $searchtext = $_GET['s'];
    $where = "s=$searchtext";
    if (isset($_GET['ta']) && $_GET['ta'] == "author") {
        $searcharticle = $_GET['ta'];
        $where .= "&ta=$searcharticle";
        $sql = "SELECT number 
            from items 
            where author in (
            SELECT username 
            from users
            where introduce like ? or nickname like ?)";
        $data = mysqlPreprocess($link, $sql, 'ss', "%{$searchtext}%", "%{$searchtext}%");
        checkdata($data);
    } else {
        $sql = "SELECT number 
            from items 
            where name like ? 
            or name in (
            SELECT name 
            from message
            where introduce like ?)";
        $data = mysqlPreprocess($link, $sql, 'ss', "%{$searchtext}%", "%{$searchtext}%");
        checkdata($data);
    }
    if (isset($_GET['ti'])) {
        $searchitem = $_GET['ti'];
        $where .= "&ti=$searchitem";
        $sql = "SELECT number from items where type = ? and FIND_IN_SET(number,?)";
        $data = mysqlPreprocess($link, $sql, 'ss', $searchitem, $numbers);
        checkdata($data);
    }
} else if (isset($_GET['type'])) {
    $type = $_GET['type'];
    switch ($type) {
        case 'novel':
            $title = "小说";
            $where = "type=novel";
            break;
        case 'comic':
            $title = "漫画";
            $where = "type=comic";
            break;
        case 'anime':
            $title = "动画";
            $where = "type=anime";
            break;
        case 'game':
            $title = "游戏";
            $where = "type=game";
            break;
    }
    $sql = "SELECT number 
            from items 
            where type = ?";
    $data = mysqlPreprocess($link, $sql, 's', $type);
    checkdata($data);
} else {
    $where = $title = "";
}
$data = null;


function addnumber($nums)
{
    $result = [];
    for ($i = 0; $i < count($nums); $i++) {
        array_push($result, $nums[$i]['number']);
    }
    $result = implode(',', $result);
    return $result;
}

function checkdata($data)
{
    global $total_records;
    global $numbers;
    if (empty($data)) {
        $total_records = 0;
        $numbers = "";
    } else {
        $total_records = count($data);
        $numbers = addnumber($data);
    }
}
