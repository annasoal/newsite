<?php

namespace Controller;

use Core\View as View;
use Model\Post as Post;
use Model\Image as Image;


class Admin extends Base
{

    private $post;

    public function __construct()
    {
        parent::__construct();
        $this->post = Post::app();
        $this->image = Image::app();
    }

    // ниже по одному методу под каждую страницу

    // добавление поста
    public function action_add(){
        $this->title = 'Добавить запись';
        $fields = ['text' => ''];

        if(count($_POST) > 0){
            if($this->post->add($_POST, $_FILES['file'])){
                header('Location: /');
                exit();
            }

            $fields = $_POST;
        }

        $this->content = View::template('v_add.php', $fields);
    }


    // Редактирование поста
    public function action_edit()
    {

        $this->title = 'Редактировать пост';
        $id = $this->params[2];
        $fields = $this->post->one($id);
        $fields['file'] = $this->image->one($fields['id_image'])['file'];


        if (isset($_POST['update'])) {
            array_pop($_POST);
            $fields = $_POST;
            //var_dump($fields);
            if ($this->post->edit($id, $fields,$_FILES['file']) !== false) {
                header('Location: /pages/one/' . $id);
                exit();
            }
        }

        $this->content = View::template('v_edit.php', $fields);

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
                exit;
            }

        }

        $this->content = View::template('v_delete.php', ['id_post' => $id]);
    }
}