<?php

	return [
        'fields' => ['id_user', 'name','id_image', 'datebirth', 'email', 'password'],
        'not_empty' => ['email', 'password', 'name'],
        'date' =>['datebirth'],
        'email' =>['email'],
        'email_domain' =>['email'],
        'range' => ['password' => [6, 64]],
        'unique' => ['email'],
        'hash' =>['password'],
        'labels' => [
            'id_image' => 'Аватар',
            'datebirth' => 'Дата рождения',
            'name' => 'Имя пользователя',
            'email' => 'Email пользователя',
            'password' => 'Пароль пользователя'
        ],
        'pk' => 'id_user'
    ];