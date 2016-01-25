<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 22.01.16
 * Time: 19:42
 */

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

