<?php

require_once __DIR__ . '/app/init.php';

$data = isset($_POST['post']) ? $_POST['post'] : [];
$post = [];
$errors = [];

if (isset($data['id'])) {
    $id = $data['id'];
}
else if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($id)) {
    $post = getPostById((int) $id);

    if (!$post) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found');
        exit('Post not found!');
    }
}

if ($data) {
    $msg = 'Запись  успешно '
        . (isset($post['id']) ? 'добавлена' : 'изменена');
    $post = savePost($data, $errors);

    if (!$errors) {
        addFlashMessage($msg);
        // Запись успешно сохранена
        header('location: edit:php?id=' . $post['id']);
        exit;
    }
}


?>

