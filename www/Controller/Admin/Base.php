<?php

namespace Controller\Admin;

use \Core\Admin\View as View;

abstract class Base extends \Controller\Core
{
    protected $params;

    // поля базового шаблона
    protected $title;
    protected $content;
    //protected $left;

    // всё, что до
    public function __construct()
    {
        $this->title = '';
        $this->content = '';
       // $this->left = '';
    }

    // всё, что после
    public function render()
    {
        $main = View::template('v_main.php', ['title' => $this->title, 'content' => $this->content]);
        echo $main;
    }

}
