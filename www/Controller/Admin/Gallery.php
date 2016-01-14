<?php


namespace Controller\Admin;

use Core\Admin\View as View;
use Core\Arr as Arr;
use Model\Gallery as MGallery;


class Gallery
    extends Base
{
    private $gallery;
    private $template;

    public function __construct()
    {
        parent::__construct();
        $this->gallery = MGallery::app();
        $this->template = 'gallery/v_gallery.php';
        $this->check_access('edit_posts');
    }


    public function action_all()
    {
        $galleries = $this->gallery->all();
        $this->content = View::template($this->template, ['galleries' => $galleries]);
    }


    public function action_add()
    {
        $galleries = $this->gallery->all();
        $errors = [];
        $fields = ['name' => ''];
        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['name']);
            if ($this->gallery->add($fields)) {
                header('Location: /' . ADMIN_URL . '/gallery/all');
                exit();
            } else {
                $errors = $this->gallery->errors();
            }
        }

        $this->content = View::template($this->template, ['fields' => $fields, 'errors' => $errors, 'galleries' => $galleries]);
    }

    public function action_upload()
    {
        $gallery = $this->gallery->one($this->params[2]);
    
        if($gallery == null)
            throw new \Exception('gallery not found');

        $this->scripts[] = 'imageuploader';
        $this->content = View::template('gallery/v_upload.php', ['gallery' => $gallery]);
    }
    
    // Редактирование
    public function action_edit()
    {
        $this->title = "Редактирование галереи";
        $id = $this->params[2];

        if (isset($_POST['update'])) {
            $fields = Arr::extract($_POST, ['name', 'comment']);

            if ($this->gallery->edit($id, $fields) !== false) {
                header('Location: /' . ADMIN_URL . '/gallery/all');
                exit();
            }
        } else {
            $fields = $this->gallery->one($id);
        }

        $this->content = View::template('gallery/v_edit.php', ['fields' => $fields]);
    }


    public function action_delete()
    {
        $this->title = 'Удаление галереи';
        $id = $this->params[2];

        if (isset ($_POST['undoDelete'])) {
            header('Location: /' . ADMIN_URL . '/gallery/all');
            exit;

        } elseif (isset($_POST['delete'])) {
            if ($this->gallery->delete($id) !== false) {
                header('Location: /' . ADMIN_URL . '/gallery/all');
                exit;
            }

        }

        $this->content = View::template('gallery/v_delete.php', ['id_gallery' => $id]);
    }
}