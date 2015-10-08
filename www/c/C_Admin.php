<?php

class C_Admin extends C_Base
{

    private $post;

    public function __construct()
    {

        parent::__construct();
        $this->post = new M_Post();
    }

    // ниже по одному методу под каждую страницу

    // добавление поста
    public function action_add()
    {

        $this->title = 'Добавить запись';
        $text = '';

        if (count($_POST) > 0) {
            if ($this->post->add($_POST['text']) == true) {
                header('Location: http://newsite');
                exit();
            }

            $text = $_POST['text'];
        }

        $this->content = M_View::template('v_add.php', ['text' => $text]);
    }

    // Редактирование поста
    public function action_editForm($id)
    {
        $this->title = 'Редактирование записи';

        if ($id != '') {

            $text = $this->post->editForm($id - 1)[2];
            $this->content = M_View::template('v_editForm.php', ['text' => $text]);

        } else {
            echo "Ошибка";//временное решение

        }

    }

    public function action_edit($id)
    {
        if (count($_POST) > 0) {
            $text = $_POST['text'];

            if ($this->post->edit($text,$id) == true) {
                header('Location: http://newsite/pages/one' . $id);
                exit();
            }

            $this->content = M_View::template('v_one.php', ['text' => $text]);
        }


    }
}