<?php
// error_reporting(0);


$link = new mysqli('127.0.0.1','root','','neri的小窝',3306);
//设置数据库输出格式
$link ->query("set names utf8");
//关闭mysql报错报告
mysqli_report(MYSQLI_REPORT_OFF);
//关闭自动提交;开启事务
$link -> autocommit(false);

//检查连接是否成功
if($link->connect_errno){
	die("数据库连接失败，错误代码为".$link->connect_errno."错误提示为".$mysqli_connect_error);
}








?>