<?php

function getActionName()
{
    $action = request()->route()->getActionName();
    $action_arr = explode('@', $action);
    return array_pop($action_arr);
}

function getControllerActionName()
{
    $action = request()->route()->getActionName();
    $action_arr = explode('Controller@', $action);
    $action = $action_arr[1];
    $controller_arr = explode('\\', $action_arr[0]);
    $controller = array_pop($controller_arr);

    return strtolower($controller) . '.' . $action;
}

function denied($message = '没有权限！')
{
    if(request()->expectsJson()) {
        return response(['success' => false, 'message' => $message]);
    } else {
        echo "<script type='text/javascript'>alert('{$message}'); window.history.back();</script>";
        exit;
    }
}

function filterNull($data)
{
    if(is_null($data)) {
        return false;
    }
    return true;
}

function getPercent($data)
{
    return (float) $data * 100 . '%';
}