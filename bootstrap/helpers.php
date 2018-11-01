<?php

function denied($message = '没有权限！')
{
    echo "<script type='text/javascript'>alert('{$message}'); window.history.back();</script>";
    exit;
}

/**
 * @return string "welcome.index"
 */
function getControllerActionName()
{
    $fullName = request()->route()->getActionName();
    $arr = explode('\\', $fullName);
    $controllerAndAction = array_pop($arr);
    $arr = explode('Controller@', $controllerAndAction);
    return strtolower(implode('.', $arr));
}

function getActionName()
{
    $action = request()->route()->getActionName();
    $action_arr = explode('@', $action);
    return array_pop($action_arr);
}

function filterNull($data)
{
    if (is_null($data)) {
        return false;
    }
    return true;
}

function getPercent($data)
{
    return (float)$data * 100 . '%';
}

// 手机号码隐藏中间四位
function yc_phone($phone)
{
    $phone_str = substr_replace($phone, '****', 3, 4);
    return $phone_str;
}