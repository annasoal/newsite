<?php

namespace Controller\Client;

use \Core\Client\View as View;

class Auth
    extends Base
{

    private $auth;

    public function __construct()
    {
        parent::__construct();

        $this->auth = \Core\Auth::app();
    }

    public function action_index(){
        // если уже авторизован, то сразу кидаем в админку
        if($this->auth->user() != false){
            header('Location: /' . ADMIN_URL );
            exit();
        }

        if(isset ($_POST['login'])){
            if($this->auth->login($_POST['email'], $_POST['password'], isset($_POST['remember']))){
                header('Location: /' . ADMIN_URL );
                exit();
            }
        }

        $this->content = View::template('v_auth.php');
    }

    public function action_logout(){
        $this->auth->logout();
        header('Location: /auth');
        exit();
    }
}