<?php

return [
    'fields' => ['id_priv', 'name', 'description'],
    'not_empty' => ['name', 'description'],
    //'html_allowed' => ['text'],
    /* 'range' => ['title' => [3, 64]],
    'exact_length' => ['text' => 30], */
    'unique' => ['name'],
    'labels' => [
        'id_priv' => 'Id привилегии',
        'name' => 'Название привилегии',
        'description' => 'Описание привилегии',

    ],
    'pk' => 'id_priv'
];