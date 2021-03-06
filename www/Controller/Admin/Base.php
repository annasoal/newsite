<?php

namespace Controller\Admin;

use Core\Admin\View as View;
use Core\Auth as Auth;


abstract class Base extends \Controller\Core
{
    protected $params;
    protected $active_user;

    // поля базового шаблона
    protected $title;
    protected $content;
    protected $scripts;
    protected $vars_to_js;

    //protected $left;

    // всё, что до
    public function __construct()
    {
        $this->title = '';
        $this->content = '';
        $this->active_user = Auth::app()->user();
        $this->scripts = [];
        $this->vars_to_js = ['admin_url' => ADMIN_URL];

        if ($this->active_user == false) {
            header("Location: /auth");
            exit();
        }
        // $this->left = '';
    }

    // всё, что после
    public function render()
    {

        $main = View::template('v_main.php', ['title' => $this->title,
            'content' => $this->content,
            'scripts' => $this->scripts,
            'vars_to_js' => $this->vars_to_js,
            'active_user' =>$this->active_user]);
        echo $main;
    }

    protected function check_access($privs)
    {
        if (!Auth::app()->can($privs)) {
            $action = 'action_access_err';
            $conrtroller = new Msg();
            $conrtroller->request($action, $this->params);
            die();
        }
    }

}