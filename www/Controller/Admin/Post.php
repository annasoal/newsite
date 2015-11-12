<?php

namespace Controller\Admin;

use Core\Admin\View as View;
use Core\Arr as Arr;
use Model\Image as Image;
use Model\Post as MPost;
use Model\Tag as Tag;


class Post
    extends Base
{

    private $post;


    public function __construct()
    {
        parent::__construct();
        $this->post = MPost::app();

        //$this->left = View::template('post/v_left.php');

        $this->image = Image::app();
        $this->tag = Tag::app();
        $this->check_access('edit_posts');

    }

    public function action_all()
    {
        $this->action_page();
    }

    public function action_page()
    {
        $page = isset($this->params[2]) ? (int)$this->params[2] : 1;
        $this->title = 'Страница ' . $page;
        $posts = $this->post->page($page);
        $posts_id = [];

        foreach ($posts as $one)
            $posts_id[] = $one['id_post'];
        // 74, 75, ///, 78
        $tags = $this->tag->getTagsForAll($posts_id);

        $pages_count = $this->post->pages_count();
        $this->content = View::template('post/v_all.php', ['posts' => $posts,
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
        $this->content = View::template('post/v_one.php', ['post' => $post, 'tags' => $tags]);
    }

    public function action_tag()
    {
        $id = $this->params[2];
        $tag = $this->tag->one($id);
        $posts = $this->post->getAllByTag($id);
        //var_dump($posts);
        $this->title = 'Новости по тегу: ' . $tag['name'];
        $posts_id = [];

        foreach ($posts as $one)
            $posts_id[] = $one['id_post'];
        // 74, 75, ///, 78
        $tags = $this->tag->getTagsForAll($posts_id);

        $this->content = View::template('post/v_allbytags.php', ['posts' => $posts, 'tags' => $tags]);
    }



    // ниже по одному методу под каждую страницу

    // добавление поста
    public function action_add()
    {
        $this->title = 'Добавить пост';
        $fields = ['text' => '', 'tags' => []];
        $errors = [];
        $tags = $this->tag->all();

        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['title', 'text']);
            $tags = $_POST['tags'];
            $id_post = $this->post->add($fields, $tags, $_FILES['file']);
            if ($id_post != false) {
                header('Location: /' . ADMIN_URL . '/post/one/' . $id_post);
                exit();
            } else {
                //$fields = Arr::extract($_POST, ['title', 'text']);
                $fields['tags'] = $tags;
                $tags = $this->tag->all();
                $errors = $this->post->errors();
            }
        }
        // в шаблон tags Model\Tags\all для селекта
        $this->content = View::template('post/v_add.php', ['fields' => $fields, 'tags' => $tags, 'errors' => $errors]);
    }


    // Редактирование поста
    public function action_edit()
    {
        $this->title = 'Редактировать пост';
        $id = $this->params[2];
        $errors = [];
        $tags = $this->tag->all();

        // 3
        if (isset($_POST['update'])) {
            $fields = Arr::extract($_POST, ['title', 'text']);
            $tags = $_POST['tags'];
            if ($this->post->edit($id, $fields, $tags, $_FILES['file']) !== false) {
                //die();
                header('Location: /' . ADMIN_URL . '/post/one/' . $id);
                exit();
            }
        } else {
            $fields = $this->post->one($id);
            $fields['tags'] = $this->tag->getIdTagsForOne($id);
            $errors = $this->post->errors();
            //var_dump($fields);
            //$tags = Tags::app()->all();

        }

        $this->content = View::template('post/v_edit.php', ['fields' => $fields, 'tags' => $tags, 'errors' => $errors]);

    }


    public function action_delete()
    {
        $this->title = 'Удаление поста';
        $id = $this->params[2];
        $return = isset($this->params[3]) ? $this->params[3] : 1;

        if (isset ($_POST['undoDelete'])) {
            header('Location: /' . ADMIN_URL . '/post/one/' . $id);
            exit;
        } elseif (isset($_POST['delete'])) {
            if ($this->post->delete($id) !== false) {
                header('Location: /' . ADMIN_URL . '/post/page/' . $return);
                exit;
            }

        }

        $this->content = View::template('post/v_delete.php', ['id_post' => $id]);
    }
}