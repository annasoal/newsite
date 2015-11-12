<?php


namespace Controller\Admin;

use Core\Admin\View as View;
use Core\Arr as Arr;
use Model\Tag as MTag;


class Tag
    extends Base
{
    private $tag;
    private $template;

    public function __construct()
    {
        parent::__construct();
        $this->tag = MTag::app();
        $this->template = 'tag/v_tags.php';
        $this->check_access('edit_posts');
    }


    public function action_all()
    {
        $tags = $this->tag->all();
        $this->content = View::template($this->template, ['tags' => $tags]);
    }


    public function action_add()
    {
        $tags = $this->tag->all();
        $errors = [];
        $fields = ['name' => ''];
        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['name', 'comment']);
            if ($this->tag->add($fields)) {
                header('Location: /' . ADMIN_URL . '/tag/all');
                exit();
            } else {
                $errors = $this->tag->errors();
            }
        }

        $this->content = View::template($this->template, ['fields' => $fields, 'errors' => $errors, 'tags' => $tags]);
    }


    // Редактирование
    public function action_edit()
    {
        $this->title = "Редактирование тега";
        $id = $this->params[2];

        if (isset($_POST['update'])) {
            $fields = Arr::extract($_POST, ['name', 'comment']);

            if ($this->tag->edit($id, $fields) !== false) {
                header('Location: /' . ADMIN_URL . '/tag/all');
                exit();
            }
        } else {
            $fields = $this->tag->one($id);
        }

        $this->content = View::template('tag/v_edit.php', ['fields' => $fields]);
    }


    public function action_delete()
    {
        $this->title = 'Удаление тега';
        $id = $this->params[2];

        if (isset ($_POST['undoDelete'])) {
            header('Location: /' . ADMIN_URL . '/tag/all');
            exit;

        } elseif (isset($_POST['delete'])) {
            if ($this->tag->delete($id) !== false) {
                header('Location: /' . ADMIN_URL . '/tag/all');
                exit;
            }

        }

        $this->content = View::template('tag/v_delete.php', ['id_tag' => $id]);
    }

}