<?php

return [
    'fields' => ['id_tag', 'name', 'comment'],
    'not_empty' => ['name'],
    //'html_allowed' => ['text'],
    /* 'range' => ['title' => [3, 64]],
    'exact_length' => ['text' => 30], */
    'unique' => ['name'],
    'labels' => [
        'id_tag' => 'Id тега',
        'name' => 'Имя тега',
        'comment' => 'Комментарий к тегу',

    ],
    'pk' => 'id_tag'
];