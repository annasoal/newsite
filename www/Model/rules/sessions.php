<?php

	return [
        'fields' => ['id_session', 'token', 'id_user', 'timestart', 'lastactivity', 'isover'],
        'not_empty' => ['token', 'id_user', 'timestart', 'lastactivity', 'isover'],
        'unique' => ['token'],
        'labels' => [],
        'pk' => 'id_session'
    ];