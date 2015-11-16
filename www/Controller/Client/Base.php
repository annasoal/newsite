<?php

namespace Controller\Client;

use Core\Auth as Auth;
use Core\Client\View as View;


abstract class Base extends \Controller\Core
{
    protected $params;

    // поля базового шаблона
    protected $title;
    protected $content;
    protected $left;
    protected $active_user;
    protected $admin_link = false;
    protected $base_template;

    // всё, что до
    public function __construct()
    {
        $this->title = '';
        $this->content = '';
        $this->left = '';
        $this->base_template = 'v_main.php';
        $this->active_user = Auth::app()->user();// авторизованный пользователь
        $this->admin_link = in_array($this->active_user['id_role'], ['1', '3']);// только для админа и модератора
    }

    // всё, что после
    public function render()
    {
        $main = View::template('base_templates/' . $this->base_template, ['title' => $this->title,
                                                                         'content' => $this->content,
                                                                         'left' => $this->left,
                                                                         'admin_link' => $this->admin_link,
                                                                         'active_user' => $this->active_user]
                              );
        echo $main;
    }

}