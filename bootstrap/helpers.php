<?php

function getActionName()
{
    $action = request()->route()->getActionName();
    $action_arr = explode('\\', $action);
    return array_pop($action_arr);
}