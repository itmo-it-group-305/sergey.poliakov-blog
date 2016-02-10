<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 22.01.16
 * Time: 19:42
 */

const MSG_TYPE_ERROR = 'error';
const MSG_TYPE_SUCCESS = 'success';


function addFlashMessage($msg, $type = MSG_TYPE_SUCCESS)
{
    if (!isset($_SESSION['messages'])) {
        $_SESSION['messages'] = [];
    }

    if (!isset($_SESSION['messages'][$type])) {
        $_SESSION['messages'][$type] = [];
    }

    is_array($msg)
        ? $_SESSION['messages'][$type] = array_merge($_SESSION['messages'][$type], $msg)
        : $_SESSION['messages'][$type][] = $msg;

}

function flushFlashMessages($type = null)
{
    $messages = [];

    if (isset($_SESSION['messages'])) {
        if ($type && isset($_SESSION['messages'][$type])) {
            $messages = $_SESSION['messages'][$type];
            unset($_SESSION['messages'][$type]);
        } else {
            $messages = $_SESSION['messages'];
            unset($_SESSION['messages']);
        }

    }

    return $messages;
}

function e ($arr, $key, $default = '')
{
    return htmlspecialchars(
        p($arr, $key, $default)
    );
}

function p($arr, $key, $default = '')
{
    return isset($arr[$key]) ? $arr[$key] : $default;
}

