<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 29.01.16
 * Time: 19:13
 */

$res = filter_var('-10', FILTER_VALIDATE_INT, [
    'options' => [
        'min_range' => -10,
        'max_range' => 10
    ],
    'flags' => FILTER_NULL_ON_FAILURE,
    ]);

var_dump($res);