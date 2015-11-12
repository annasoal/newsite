<?php

return [
    'fields' => ['id_page', 'id_parent', 'url', 'full_url', 'title', 'content'],
    'not_empty' => ['id_parent', 'url', 'title', 'content'],
    'html_allowed' => ['content'],
    'unique' => ['full_url'],
    'labels' => [
        'id_parent' => 'Родительский раздел',
        'url' => 'Урл',
        'title' => 'Заголовок',
        'content' => 'Текст',
    ],
    'pk' => 'id_page'
];