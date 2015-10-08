<?php
class C_Pages extends C_Base{

    private $post;

    public function __construct(){
        parent::__construct();
        $this->left = M_View::template('v_left.php');
        $this->post = new M_Post();
    }

    // ниже по одному методу под каждую страницу
    //главная
    public function action_index(){

        $this->title = 'Главная';
        $posts = $this->post->all();
        $this->content = M_View::template('v_index.php', ['posts' => $posts]);
    }
    public function action_one(){
        $this->title = 'Новость';
        $this->content = M_View::template('v_one.php');
    }
    // контакты
    public function action_contacts(){
        $this->title = 'Контакты';
        $this->content = M_View::template('v_contacts.php');
    }

    // о нас
    public function action_about(){
        $this->title = 'О нас';
        $this->content = M_View::template('v_about.php');
    }


}