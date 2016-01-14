<?php

return [
    'fields' => ['id_gallery', 'name', 'dt'],
    'not_empty' => ['name'],
    //'html_allowed' => ['text'],
    /* 'range' => ['title' => [3, 64]],
    'exact_length' => ['text' => 30], */
    'unique' => ['name'],
    'labels' => [
        'id_gallery' => 'Id галереи',
        'name' => 'Имя галереи',
        'dt' => 'Дата создания',

    ],
    'pk' => 'id_gallery'
];