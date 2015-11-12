<?php

namespace Controller\Client;

use \Core\Client\View as View;
use \Core\Auth as Auth;


abstract class Base extends \Controller\Core
{
    protected $params;

    // поля базового шаблона
    protected $title;
    protected $content;
    protected $left;
    protected $active_user;


    // всё, что до
    public function __construct()
    {
        $this->title = '';
        $this->content = '';
        $this->left = '';
        $this->active_user = Auth::app()->user();
    }

    // всё, что после
    public function render()
    {
        $main = View::template('v_main.php', ['title' => $this->title, 'content' => $this->content, 'left' => $this->left]);
        echo $main;
    }

}
