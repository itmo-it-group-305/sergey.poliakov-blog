<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 18.01.16
 * Time: 18:56
 */

const ENTITY_POST = 'post';

//Так мы получаем все посты

function getAllPosts () {
   /* Мы возвращаем многомерный массив. На верхнем уровне он нумерованный. Каждый его элемент - это подмассив,
    либо это может быть объект. Как нам больше нравится. Мы не знаем пока объекты, поэтому это будет массив
   mktime() - возвращает время в виде целой цифры*/
    return storageGetAll(ENTITY_POST);
}

//Получаем уникальный пост по By - то есть по ID, соответственно id мы и передаем в функцию
function getPostById ($id) {

    return storageGetItemByID(ENTITY_POST, $id);
//    $items = getAllPosts();
//
//    foreach ($items as $storedItem) {
//        if ($storedItem['id'] == $id) {
//            return $storedItem;
//        }
//    }
//
//    return null;

}

//Добавление и редактирование поста

function savePost ($data, &$errors = null)

{
    $id = isset($data['id']) ? $data['id'] : null;
//    $post = getPostById($id) ?: [];
//
//    if ($id && !$post) {
//        return false;
//    }
//
//
//    $post = array_merge($post, $data);
    $post = $data; // результат после очистки и валидации

    if ($errors) {
        return $post;
    }

    $post['updated'] = mktime();

    if (!$id) {
        $post['created'] = mktime();
    }

    $status = storageSaveItem(ENTITY_POST, $post);

    if(!$status) {
        $errors['db'] = 'Не удалось записать данные в базу';
    }

    return $post;

//    // @fixme: нужно возвращать другое значение
//    $post = storageSaveItem(ENTITY_POST, $post);
//
//    if (!$post) {
//        $errors['db'] = 'Не удалось записать данные в базу';
//    }
}

