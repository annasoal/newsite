<?php

namespace Controller\Admin;

use \Core\Admin\View as View;



abstract class Base extends \Controller\Core
{
    protected $params;
    protected $active_user;

    // поля базового шаблона
    protected $title;
    protected $content;
    //protected $left;

    // всё, что до
    public function __construct()
    {
        $this->title = '';
        $this->content = '';
        $this->active_user = \Core\Auth::app()->user();

        if($this->active_user == false){
            header("Location: /auth");
            exit();
        }
       // $this->left = '';
    }

    // всё, что после
    public function render()
    {
        $main = View::template('v_main.php', ['title' => $this->title, 'content' => $this->content]);
        echo $main;
    }

}
