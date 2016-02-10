<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 18.01.16
 * Time: 18:54
 */

require_once __DIR__ . '/app/init.php';

$post = getPostById(isset ($_GET['id']) ? $_GET['id'] : '');

if (!$post) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found');
    exit('Post not found!');

}

var_dump($post);

require_once __DIR__ . '/app/views/show.php';

?>


