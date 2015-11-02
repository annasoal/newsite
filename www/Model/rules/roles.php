<?php

	return [
        'fields' => ['id_role', 'name', 'description'],
        'not_empty' => ['name'],
        //'html_allowed' => ['text'],
        /* 'range' => ['title' => [3, 64]],
        'exact_length' => ['text' => 30], */
        'unique' => ['name'],
        'labels' => [
            'id_role' => 'Id роли',
            'name' => 'Название роли',
            'description' => 'Описание роли',

        ],
        'pk' => 'id_role'
    ];