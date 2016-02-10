<?php

function sanitize (array $data, array $rules, array &$errors = null)
{
    $errors = is_array($errors) ? $errors : [];

//    1. подготовка валидации/фильтрации

    foreach ($rules as $attribute => $rule) {
        $rule['flags'] = isset($rule['flags'])
            ? $rule['flags'] | FILTER_NULL_ON_FAILURE
            : FILTER_NULL_ON_FAILURE;

        $rule['required'] = isset($rule['required'])
            ? (bool) $rule['required']
            : false;

        $rule['message'] = isset($rule['message']) ? $rule['message'] : '';

        $rule[$attribute] = $rule;
    }

    var_dump($rule);

//    2. непосредтвенная валидация/фильтрация

    $data = array_map('trim', $data);
    $filteredData = filter_var_array($data, $rules);

    foreach ($filtredData as $attribute => $value) {
        $rule = $rules[$attribute];

        (is_null($value)) {
            if ($data[$attribute] || ($data[$attribute] === '' && $rule['required'])) {
                sanitizeAddError(
                    $attribute,
                    $rule['message'] ?: 'Не корректное значение в поле "{attribute}'.',
                    $errors
                )
            };

        }

    }

    $filtredData = filter_var_array($data, $rules);

    $foreach ($filtredData as $attribute => $value) {
    $rule = $rules[$attribute];

    if (is_null($value)) {
        sanitizeAddError(
            $attribute,
            'Не корректиное значение в поле "{attribute}'.'',
            $errors
        );
    }

   return $filtredData

}

}

function sanitizeAddError($attribute, $message, array &$errors)
{
    $errors[$attribute] = atrtr($message, [
        '{attribute}' => $attribute;
    ])
}

$data = [
    'username' => 'piska-popkin',
    'password' => 'qwerty'
];

$rules = [
    'username' => [
        'required' => true,
        'filter' => FILTER_VALIDATE_REGEXP,
        'message' => 'Имя пользователя должно быть больше 4-ех симовлов и содержать',
        'options' => [
//            'regexp' => '~[a-z0-9_-]{4,}$-i',
    ],
    ],
    'password' => [
        'required' => true,
        'filter' => FILTER_VALIDATE_REGEXP,
        'options' => [
//            'regexp' => '~[\s]{4.}$-i'
        ],
    ],
    'message' => 'Пароль должен быть больше 4-ех симовлов и содержать',
];

$errors = [];

sanitize($data, $rules, $errors);

//0111101101 => unix/linux права доступа
//-rwxrwetwe => read write execute
//Author Group Other