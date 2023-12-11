<?php

/**
 * 获取用户真实IP地址
 *
 * @return string 用户真实IP地址
 */
function getUserIP()
{
    // 获取用户IP地址
    $ip = $_SERVER['REMOTE_ADDR'];

    // 检查是否使用代理服务器
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // 获取代理服务器IP地址
        $proxyIP = $_SERVER['HTTP_X_FORWARDED_FOR'];

        // 使用第一个IP地址作为真实IP地址
        $ip = explode(',', $proxyIP)[0];
    }

    return $ip;
}
