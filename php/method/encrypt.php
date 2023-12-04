<?php
function encrypt($str,$token=""){
    $str = str_split(md5($str));
    if(empty($token)){
        $token = str_split(md5(uniqid(microtime(true),true)));
    }
    else{
        $token = str_split(md5($token));
    }
    $result = "";
    for ($i=0; $i < 32; $i++) { 
        $result.=$str[$i].$token[$i];
    }
    $result = md5($result);
    return $result;
}
?>