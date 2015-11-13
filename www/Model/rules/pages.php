<?php
return [
    'fields' => ['id_page', 'id_parent', 'url', 'full_url', 'title', 'content', 'base_template', 'inner_template'],
    'not_empty' => ['id_parent', 'url', 'title', 'content', 'base_template', 'inner_template'],
    'html_allowed' => ['content'],
    'unique' => ['full_url'],
    'labels' => [
        'id_parent' => 'Родительский раздел',
        'url' => 'Урл',
        'title' => 'Заголовок',
        'content' => 'Текст',
        'base_template' => 'Базовый шаблон',
        'inner_template' => 'Внутренний шаблон',
    ],
    'pk' => 'id_page'
];