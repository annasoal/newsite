<?php

namespace Core;

use \Model\User as User;
use \Model\Session as Session;

class Auth
{
    private static $instance;
    private $user;
    private $token;
    private $users;
    private $sessions;
    private $privs;

    public static function app(){
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct(){
        $this->user = null;
        $this->token = null;
        $this->privs = null;
        $this->users = User::app();
        $this->sessions = Session::app();
    }

    public function user(){
        if($this->user === null){
            $token = $_SESSION['token'];

            if($token == null){
                $token = $_COOKIE['token'];

                if($token != null)
                    $_SESSION['token'] = $token;
            }

            if($token == null)
                $this->user = false;
            else {
                $id_user = $this->sessions->getByToken($token);

                if($id_user == false){
                    unset($_SESSION['token']);
                    setcookie('token', $this->token, time() - 1, '/');
                }
                else{
                    $this->user = $this->users->one($id_user);

                    if($this->user == null){
                        $this->user = false;
                        unset($_SESSION['token']);
                        setcookie('token', $this->token, time() - 1, '/');
                    }
                }
            }
        }

        return $this->user;
    }

    public function login($email, $password, $remember){
        $user = $this->users->getByLogin($email);

//var_dump($user);
        if($user == null)
            return false;

        $value = hash('sha256', $password . AUTH_SALT);

        if($user['password'] != $value)
            return false;

        $this->user = $user;
        $this->token = $this->sessions->open($user['id_user']);
        $_SESSION['token'] = $this->token;

        if(isset($remember)){
            setcookie('token', $this->token, time() + 3600 * 24 * 7, '/');
        }

        return true;
    }

    public function logout(){
        $this->sessions->deleteByToken($_SESSION['token']);
        unset($_SESSION['token']);
        setcookie('token', $this->token, time() - 1, '/');
    }

    public function can($priv){
        if($this->privs === null){
            $user = $this->user();

            if($user == false)
                $this->privs = [];
            else
                $this->privs = $this->users->getPrivs($user['id_user']);
        }

        return in_array($priv, $this->privs);
    }
}