<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 25.01.16
 * Time: 11:29
 */

require_once __DIR__ . '/libs/storage.php';
require_once __DIR__ . '/libs/view.php';
require_once __DIR__ . '/app/models/user.php';

$data = isset($_POST['user']) ? $_POST['user'] : [];
$user = [];
$errors = [];

if (isset($data['id'])) {
    $id = $data['id'];
}
else if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if (isset($id)) {
    $user = getUserById((int) $id);

    if (!$user) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not found');
        exit('User not found!');
    }
}

if ($data) {
    $user = saveUser($data, $errors);

    if (!$errors) {
        // Запись успешно сохранена
        header('location: edit:php?id=' . $user['id']);
        exit;
    }
}


?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Бложег</title>
</head>
<script type="text/javascript" src="js/passvalidator.js"></script>
<body>
<form action="" method="post">
    <h2>Регистрация/редактирование юзера</h2>
    <div>
        <div class="error">
            <?= e($errors, 'title') ?>
        </div>
        <label for="user_name">Имя пользователя</label>
        <input id="user_name" name="user[name]" type="text" value="<?= e($user, 'name') ?>" required>
    </div>
    <div>
        <div class="error">
            <?= e($errors, 'password') ?>
        </div>
        <label for="user_password">Пароль</label>
        <input id="user_password" name="user[password]" type="password" value="<?= e($user, 'password') ?>" required>
    </div>

<!--    @todo: написать валидацию пароля на js/jQuery-->
    <div>
        <div class="error">
            <?= e($errors, 'password') ?>
        </div>
        <label for="user_password2">Подтвержите пароль</label>
        <input id="user_password2" type="password" required>
<!--        <input id="user_password2" name="user[password]" type="password" value="--><?//= e($user, 'password') ?><!--" required>-->
    </div>

    <?php if (isset($user['id'])) :?>
        <div>
            <input type="hidden" name="user[id]" value="<?= e($user, 'id') ?>"
        </div>
    <?php endif; ?>
    <div>
        <input type="submit" class="validate">
    </div>
</form>
</body>

</html>