<?php
/**
 * Created by PhpStorm.
 * User: sergeypoliakov
 * Date: 20.01.16
 * Time: 18:50
 */

const DB_DIR = 'db';

function createFilenameItem($entitiy, $id)
{
    return DB_DIR . DIRECTORY_SEPARATOR . sprintf(
        getFilenamePattern($entitiy), $id
    );
}

// entityName_id.json => post_n.json. user_n.json

function getFilenamePattern($entitiy)
{
    return $entitiy . '_%d.json';
}

function storageGetALL ($entitiy)
{
    $items = [];
    $dir = @opendir(DB_DIR);

    if (!$dir) {
        return $items;
    }

    do {
        $filename = readdir($dir);

        list($id) = sscanf($filename, getFilenamePattern($entitiy));

        if ($id) {
            $items[] = storageGetItemByID($entitiy, $id);
        };
    } while ($filename);

    closedir($dir);

    return $items;
}

function storageGetItemByID($entitiy, $id)
{
    $filename = createFilenameItem($entitiy, $id);
    if (!is_readable($filename)) {
        return null;
    }

    return json_decode(
        file_get_contents($filename), true
    );
}

function storageSaveItem($entitiy, &$item)
{
    $id = isset($item['id']) ? $item['id'] : 0;
    $storedItem = storageGetItemByID($entitiy, (int) $id) ?: [];

    if ($id && !$storedItem) {
        return false;
    }

    $item = array_merge($storedItem, $item);


    if (!$id) {
        $items = storageGetALL($entitiy);

        foreach ($items as $storedItem) {
            if ($storedItem['id'] > $id) {
                $id = $storedItem['id'];
            }
        }

        $id += 1;
//        $length = count($items);
//        $id = $length ? $items[$length-1]['id'] + 1 : 1;
//        $item['id'] = $id;
    }

    $item['id'] = (int) $id;

    $filename = createFilenameItem($entitiy, $id);
    $status = file_put_contents($filename, json_encode($item), LOCK_EX);

    return (bool) $status;
}