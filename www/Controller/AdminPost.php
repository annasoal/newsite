<?php

namespace Controller;

use Core\View as View;
use Model\Post as Post;

use Core\Arr as Arr;


class AdminPost extends Base
{

    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->post = Post::app();
    }

    // ниже по одному методу под каждую страницу

    // добавление поста
    public function action_add(){
        $this->title = 'Добавить запись';
        $fields = ['text' => ''];

        if(count($_POST) > 0){
            // $_POST[tags] -> массив с номера тегов
            // $this->post->add($_POST, $_FILES['file'], $_POST[tags])

            if($this->post->add($_POST, $_FILES['file'])){
                header('Location: /');
                exit();
            }

            $fields = $_POST;
        }

        // в шаблон tags Model\Tags\all для селекта
        $this->content = View::template('v_add.php', ['fields' => $fields]);
    }


    // Редактирование поста
    public function action_edit()
    {

        $this->title = 'Редактировать пост';
        $id = $this->params[2];

        // 3
        if (isset($_POST['update'])) {
            $fields = Arr::extract($_POST, ['title', 'text']);

            if ($this->post->edit($id, $fields, $_FILES['file']) !== false) {
                //die();
                header('Location: /post/one/' . $id);
                exit();
            }
        }
        else{
            $fields = $this->post->one($id);
        }

        $this->content = View::template('v_edit.php', ['fields' => $fields]);

    }



    public function action_delete()
    {
        $this->title = 'Удаление поста';
        $id = $this->params[2];
        //$postCurrent = $this->post->one($id);

        if (isset ($_POST['undoDelete'])) {
            //$this->content = View::template('v_one.php', $this->post->one($id));
            header('Location: /page/one/' . $id);

        } elseif (isset($_POST['delete'])) {
            if ($this->post->delete($id) !== false) {
                header('Location: /');
                exit;
            }

        }

        $this->content = View::template('v_delete.php', ['id_post' => $id]);
    }
}