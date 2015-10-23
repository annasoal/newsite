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
        $this->title = 'Страница ' . $page;
        $posts = $this->post->page($page);
        $posts_id = [];

        foreach($posts as $one)
            $posts_id[] = $one['id_post'];
        // 74, 75, ///, 78
        $tags = $this->tag->getTagsForAll($posts_id);

        $pages_count = $this->post->pages_count();
        $this->content = View::template('v_index.php', ['posts' => $posts,
                                                        'pages_count' => $pages_count,
                                                        'page' => $page,
                                                        'tags' => $tags]
                                        );
    }

    public function action_one()
    {
        $this->title = 'Новость';
        $id = $this->params[2];
        $post = $this->post->one($id);
        $tags = $this->tag->getTagsForOne($id);
        $this->content = View::template('v_one.php', ['post' => $post,'tags' => $tags]);
    }


    public function action_postsByTag()
    {
        $id = $this->params[2];
        $tag = $this->tag->one($id);
        $posts = $this->post->getAllByTag($id);
        //var_dump($posts);
        $this->title = 'Новости по тегу: ' . $tag['name'];
        $posts_id = [];

        foreach($posts as $one)
            $posts_id[] = $one['id_post'];
        // 74, 75, ///, 78
        $tags = $this->tag->getTagsForAll($posts_id);

        $this->content = View::template('v_allbytags.php', ['posts' => $posts, 'tags' => $tags ]);
        }



}