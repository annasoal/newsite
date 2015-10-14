<?php

namespace Controller;

use \Core\View as View;
use \Model\Post as Post;
use \Model\Image as Image;

class Pages extends Base
{

    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->left = View::template('v_left.php');
        $this->post = Post::app();
        $this->image = Image::app();
    }

    // ниже по одному методу под каждую страницу
    //главная
    public function action_index()
    {

        $this->title = 'Главная';
        $posts = $this->post->all();
        foreach ($posts as $key=>$value) {
            $posts[$key]['file'] = $this->image->one($posts[$key]['id_image'])['file'];
        }
        $this->content = View::template('v_index.php', ['posts' => $posts]);
    }

    public function action_one()
    {
        $this->title = 'Новость';
        $id = $this->params[2];
        $post = $this->post->one($id);
        $post['file'] = $this->image->one($post['id_image'])['file'];
        $this->content = View::template('v_one.php', $post);
    }

    // контакты
    public function action_contacts()
    {
        $this->title = 'Контакты';
        $this->content = View::template('v_contacts.php');
    }

    // о нас
    public function action_about()
    {
        $this->title = 'О нас';
        $this->content = View::template('v_about.php');
    }

}