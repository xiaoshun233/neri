<?php
    if (isset($_GET["number"])){
        $number  = $_GET["number"];
        include_once './php/method/mysqlPreprocess.php';
        $sql = "SELECT a.name as name,type,inbound_link,introduce,number
                from items as a 
                left join message as b
                on a.name = b.name
                where number= ?";
        $result = mysqlPreprocess($link,$sql,'i',$number);
        if(!empty($result)){
            $data = $result[0];
            $result = null;
        }
    }//获取当前所在位置
    else{
        $number = null;
    }
?>