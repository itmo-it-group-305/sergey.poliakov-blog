<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 25.01.16
 * Time: 11:27
<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 18.01.16
 * Time: 18:56
 */

const ENTITY_USER = 'user';

function getUserBy($attribute, $value)
{
    return storageGetItemBy(ENTITY_USER, $attribute, $value);
}


function getAllUsers () {
    return storageGetAll(ENTITY_USER);
}

function getUserById ($id)
{

    return storageGetItemByID(ENTITY_USER, $id);
};

//@todo: продолжить здесь!


    function saveUser ($data, &$errors = null)

    {
        $id = isset($data['id']) ? $data['id'] : null;

        $user = $data; // результат после очистки и валидации

        if ($errors) {
            return $user;
        };

        $status = storageSaveItem(ENTITY_USER, $user);

        if(!$status) {
            $errors['db'] = 'Не удалось записать данные в базу';
        };

        return $user;


    }


