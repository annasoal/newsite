<?php

return [
    'fields' => ['id_post', 'id_image', 'date', 'title', 'text'],
    'not_empty' => ['title', 'text'],
    'html_allowed' => ['text'],
    /* 'range' => ['title' => [3, 64]],
    'exact_length' => ['text' => 30], */
    'unique' => ['title'],
    'labels' => [
        'id_image' => 'Изображение',
        'date' => 'Дата создания',
        'title' => 'Заголовок поста',
        'text' => 'Текст поста',
    ],
    'pk' => 'id_post'
];