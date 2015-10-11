<?php

namespace Controllers;

use Core\View as View;
use Models\Post as Post;


class Admin extends Base
{

    private $post;

    public function __construct()
    {

        parent::__construct();
        $this->post = new Post();
    }

    // ниже по одному методу под каждую страницу

    // добавление поста
    public function action_add()
    {
        $this->title = 'Добавить пост';
        $titlePost = '';
        $textPost = '';

        if (count($_POST) > 0) {
            $titlePost = $_POST['title'];
            $textPost = $_POST['text'];
            $newFilename = __DIR__ . '/../images/' . basename($_FILES['file']['name']);
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                move_uploaded_file($_FILES['file']['tmp_name'], $newFilename);
            }
            $imgDescriptionPost = $_POST['imgDescription'];
            $res = $this->post->add($titlePost, $textPost, $newFilename, $imgDescriptionPost);

            if ($res != false) {
                $id = $res;
                header('Location: /pages/one/' . $id);
                exit();
            }
        }
        $this->content = View::template('v_add.php', ['title_post' => $titlePost, 'text_post' => $textPost]);
    }

    // Редактирование поста
    public function action_edit()
    {
        $this->title = 'Редактировать пост';
        $id = $this->params[2];
        $postCurrent = $this->post->one($id);

        $titlePost = $postCurrent['title_post'];
        $textPost = $postCurrent['text_post'];

        //var_dump($postCurrent->title_post);
        //var_dump($titlePost);

        if (isset($_POST['update'])) {
            if ($titlePost !== '' && $textPost !== '') {
                $titlePost = $_POST['title'];
                $textPost = $_POST['text'];
                if ($this->post->edit($id, $titlePost, $textPost) !== false) {

                    header('Location: /pages/one/' . $id);
                }
            }
        }
        $this->content = View::template('v_edit.php', ['title_post' => $titlePost, 'text_post' => $textPost, 'id_post' => $id]);
    }

    public function action_delete()
    {
        $this->title = 'Удаление поста';
        $id = $this->params[2];
        //$postCurrent = $this->post->one($id);

        if (isset ($_POST['undoDelete'])) {
            //$this->content = View::template('v_one.php', $this->post->one($id));
            header('Location: /pages/one/' . $id);

        } elseif (isset($_POST['delete'])) {
            if ($this->post->delete($id) !== false) {
                header('Location: /');
            }

        }

        $this->content = View::template('v_delete.php', ['id_post' => $id]);
    }
}