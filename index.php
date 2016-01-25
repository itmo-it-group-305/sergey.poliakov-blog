<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 18.01.16
 * Time: 18:49
 */

/*Сегодня - одна из главных и становых лекций по курсу PHP.
Взаимодействие с пользователем.

libs содержит библиотеку, то есть всё, что не нужно менять и можно использовать в разных проектах.

app содержит только то, что привязано к конкретному приложению.

app содержит models и три классические папки:
controllers, models, views

index.php содержит все записи нашего блога.

show.php отображает конкретно одну запись нашего блога.

В edit.php у нас логика и добавления, и редактирования записи блога.

Всё то, что относится к работе с данными, мы будем хранить в "модельке"

post.php находится в models

Всегда нужно стараться отделять по возможности php от html

Мы отделяем всю логику работы с данными вверх отдельно, а весь html - вниз отдельно

Два подчёркивания перед конснатнами, у них на конеце нет разделителя директорий

__DIR__ - взозвращает путь до текущей директории

array parse_url( string url [. int component] )

В PHP можно разбирать массивы

 */

require_once __DIR__ . '/libs/storage.php';
require_once __DIR__ . '/app/models/post.php';

var_dump (
    storageSaveItem('post', [
        'title' => 'Post #1',
        'content' => 'First post',
        ]
    )
);

$posts = getAllPosts();

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Бложег</title>
</head>
<body>
    <?php foreach ($posts as $post): ?>
        <section>
            <header>
                <h2>
                    <a href="show.php?id=<?= $post['id'] ?>">
                    <?= $post['title'] ?>
                    </a>
                </h2>
            </header>
            <ul>
                <li>Создан <?= date('Y-m-d H:i', $post['created']) ?></li>
                <li>Обновлен <?= date('Y-m-d H:i', $post['updated']) ?></li>
            </ul>
            <p>
                <?= $post['content'] ?>
            </p>
        </section>
    <?php endforeach; ?>
</body>
</html>

