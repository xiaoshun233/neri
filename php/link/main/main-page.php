<?php
if (isset($_GET["number"])) {
    $number  = $_GET["number"];
    include_once './php/method/mysqlPreprocess.php';
    $sql = "SELECT a.name as name,c.alias as type,inbound_link,introduce,a.number as number
            from items as a 
            left join message as b
            on a.name = b.name
            left join item_type as c
            on c.name = a.type
            where a.number= ?";
    $result = mysqlPreprocess($link, $sql, 'i', $number);
    if (!empty($result)) {
        $data = $result[0];
        $result = null;
    }
} //获取当前所在位置
else {
    $number = null;
}
