<?php
	return [
        'fields' => ['id_comment', 'id_user', 'id_post', 'dt', 'text'],
        'not_empty' => ['text'],
        'html_allowed' => [],
        'labels' => [
            'text' => 'Текст комментария',
        ],
        'pk' => 'id_comment'
    ];