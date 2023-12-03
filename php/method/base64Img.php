<?php

//提取图片文件名(支持base64)
function getimgsuffix($name){
    $info = getimagesize($name);
    $suffix = false;
    if($mime = $info['mime']){
        $suffix = explode('/',$mime)[1];
    }
    return $suffix;
}
?>