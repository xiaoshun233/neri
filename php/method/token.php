<?php
// 设置token
function setToken($name, $value = "")
{
    require_once './../link/public/session.php';
    if (empty($value)) {
        $_SESSION[$name] = md5(uniqid(microtime(true), true));
    } else {
        $_SESSION[$name] = $value;
    }
    $result = isset($_SESSION[$name]) ? true : false;
    return $result;
}

//判断token和值是否相等
function validToken($name, $value)
{
    require_once './../link/public/session.php';
    if (!isset($_SESSION[$name])) return false;
    $result = $value === $_SESSION[$name] ? true : false;
    return $result;
}

//如果token为空则生成一个token
function checkToken($name)
{
    require_once './../link/public/session.php';
    if (!isset($_SESSION[$name]) || empty($_SESSION[$name])) {
        setToken($name);
        return false;
    } else {
        return $_SESSION[$name];
    }
}

function getToken($name)
{
    require_once './../link/public/session.php';
    return isset($_SESSION[$name]) ? $_SESSION[$name] : false;
}

function removeToken($name)
{
    require_once './../link/public/session.php';
    unset($_SESSION[$name]);
}
