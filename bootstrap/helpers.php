<?php

function getActionName()
{
    $action = request()->route()->getActionName();
    $action_arr = explode('@', $action);
    return array_pop($action_arr);
}

function denied($message = '没有权限！')
{
    echo "<script type='text/javascript'>alert('{$message}'); window.history.back();</script>";
    exit;
}

function filterNull($data)
{
    if(is_null($data)) {
        return false;
    }
    return true;
}