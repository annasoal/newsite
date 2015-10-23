<?php


namespace Controller;

use Core\Arr as Arr;
use Core\View as View;
use Model\Tag as TagModel;


class AdminTag
    extends Base
{
    private $tag;
    private $template;

    public function __construct()
    {
        parent::__construct();
        $this->tag = TagModel::app();
        $this->template = 'v_admin_tags.php';
    }


    public function action_index()
    {
        $tags = $this->tag->all();
        $this->content = View::template($this->template, ['tags' => $tags]);
    }


    public function action_add()
    {
        $tags = $this->tag->all();
        $errors =[];
        $fields = ['name' => ''];
        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['name', 'comment']);
            if ($this->tag->add($fields)) {
                header('Location: /adminTag');
                exit();
            } else {
                 $errors = $this->tag->errors();
            }
        }

        $this->content = View::template($this->template, ['fields' => $fields, 'errors' =>$errors, 'tags'=>$tags]);
    }


    // Редактирование
    public function action_edit()
    {
        $this->title = "Редактирование тега";
        $id = $this->params[2];

        if (isset($_POST['update'])) {
            $fields = Arr::extract($_POST, ['name', 'comment']);

            if ($this->tag->edit($id, $fields) !== false) {
                header('Location: /adminTag/');
                exit();
            }
        } else {
            $fields = $this->tag->one($id);
        }

        $this->content = View::template('v_admin_tags_edit.php', ['fields' => $fields]);
    }


    public function action_delete()
    {
        $this->title = 'Удаление тега';
        $id = $this->params[2];

        if (isset ($_POST['undoDelete'])) {
            header('Location: /adminTag/');
            exit;

        } elseif (isset($_POST['delete'])) {
            if ($this->tag->delete($id) !== false) {
                header('Location: /adminTag/');
                exit;
            }

        }

        $this->content = View::template('v_delete_tag.php', ['id_tag' => $id]);
    }

}