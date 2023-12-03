<?php
// 检测用户名密码是否合法
function checkLegitimate($str,$re){
    $result = preg_match($re,$str);
    return $result;
}

//检查用户名和密码长度
function checkLength($str,$min,$max){
    $Strlength = strlen($str);
    $result = ($Strlength>=$min&&$Strlength<=$max)?true:false;
    return $result;
}

?>