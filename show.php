<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 18.01.16
 * Time: 18:54
 */

require_once __DIR__ . '/libs/storage.php';
require_once __DIR__ . '/app/models/post.php';

$post = getPostById(isset ($_GET['id']) ? $_GET['id'] : '');

if (!$post) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found');
    exit('Post not found!');

}

var_dump($post);

?>


<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $post['title'] ?></title>
</head>
<body>
    <h1><?= $post['title'] ?></h1>
    <p>Создано <?= $post['created'] ?></p>
    <p>Обновлено <?= $post['updated'] ?></p>
    <?= $post['content'] ?>
</body>
</html>