<?php

return [
    'fields' => ['id_role', 'role', 'description'],
    'not_empty' => ['role'],
    //'html_allowed' => ['text'],
    /* 'range' => ['title' => [3, 64]],
    'exact_length' => ['text' => 30], */
    'unique' => ['role'],
    'labels' => [
        'id_role' => 'Id роли',
        'role' => 'Название роли',
        'description' => 'Описание роли',

    ],
    'pk' => 'id_role'
];