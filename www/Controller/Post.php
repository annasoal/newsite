<?php

namespace Controller;

use \Core\View as View;
use \Model\Post as PostModel;
use \Model\Image as Image;
use \Model\Tag as Tag;

class Post extends Base
{
    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->left = View::template('v_left.php');
        $this->post = PostModel::app();
        $this->image = Image::app();
        $this->tag = Tag::app();
    }

    // ниже по одному методу под каждую страницу
    //главная
    public function action_index(){
        $this->action_page();
    }

    public function action_page()
    {
        $page = isset($this->params[2]) ? (int)$this->params[2] : 1;
        $this->title = 'Страница: ' . $page;
        $posts = $this->post->page($page);
        $pages_count = $this->post->pages_count();
        $this->content = View::template('v_index.php', ['posts' => $posts, 'pages_count' => $pages_count, 'page' => $page]);
    }

    public function action_one()
    {
        $this->title = 'Новость';
        $id = $this->params[2];
        $post = $this->post->one($id);
        $this->content = View::template('v_one.php', $post);
    }

    public function action_tag()
    {
        $id = $this->params[2];
        $tag = $this->tag->one($id);

        // проверка на 404-ую ошибку, если тег не нашли

        $this->title = 'Новости по тегу: ' . $tag['name'];

        $posts = $this->post->getByTag($id);
        //var_dump($posts);
    }
}