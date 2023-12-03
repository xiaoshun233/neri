<?php //根据页数名称获取数据库二进制图片输出
require "./../link/public/mysql.php";
if (isset($_GET["number"])){
    $number  = $_GET["number"]; 
}//查询内容
if (isset($_GET["img"])){
    $num  = $_GET["img"]; 
}//获得图片get
include_once '../method/mysqlPreprocess.php';
$sql = "SELECT content,contenttype 
        from screenshot 
        where name=(SELECT name from items where number = ?)limit $num,1";
    $data = mysqlPreprocess($link,$sql,'i',$number)[0];
    header("Content-Type:{$data['contenttype']}");
    echo $data['content'];//根据get值输出图片
?>