<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 18.01.16
 * Time: 18:49
 */

$count = isset($_COOKIE['counter']) ? $_COOKIE['counter'] : 0;
$count += 1;
setcookie('counter', $count);

echo 'Вы посетили данную страничку ' . $count . 'раз!';

/*Сегодня - одна из главных и становых лекций по курсу PHP.
Взаимодействие с пользователем.

libs содержит библиотеку, то есть всё, что не нужно менять и можно использовать в разных проектах.

app содержит только то, что привязано к конкретному приложению.

app содержит models и три классические папки:
controllers, models, views

index_old.php содержит все записи нашего блога.

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

require_once __DIR__ . '/app/init.php';

//var_dump (
//    storageSaveItem('post', [
//        'title' => 'Post #1',
//        'content' => 'First post',
//        ]
//    )
//);

$posts = getAllPosts();

require_once __DIR__ . '/app/vievs/list.php'

?>


