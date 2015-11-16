<?php

namespace Controller\Admin;

use Core\Admin\View as View;
use Core\Template as Template;
use Core\Arr as Arr;
use Model\Page as MPage;

class Page extends Base
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = MPage::app();
        $this->check_access('edit_pages');
    }

    public function action_index()
    {
        $pages = $this->model->tree();
        $this->content = View::template('page/v_index.php', ['pages' => $pages, 'active_user' => $this->active_user]);
    }


    public function action_add(){
        $this->title = 'Добавить страницу';
        $fields = [];
        $errors = [];

        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['id_parent', 'url', 'title', 'content', 'base_template', 'inner_template']);
            $id = $this->model->add($fields);

            if ($id != false) {
                header('Location: /' . ADMIN_URL . '/page/');
                exit();
            } else {
                $errors = $this->model->errors();
            }
        }

        $this->scripts[] = 'ckeditor/ckeditor';
        $this->scripts[] = 'url_page';
        $this->scripts[] = 'ck_init';
        $this->content = View::template('page/v_add.php', ['fields' => $fields,
            'errors' => $errors,
            'pages' => $this->model->tree(),
            'base_templates' => Template::all('base'),
            'inner_templates' => Template::all('inner')
        ]);
    }

    public function action_edit()
    {
        $this->title = 'Редактировать страницу';
        $id = $this->params[2];
        $errors = [];

        if (isset($_POST['update'])) {
            $fields = Arr::extract($_POST, ['id_parent', 'url', 'title', 'content', 'base_template', 'inner_template']);

            if ($this->model->edit($id, $fields)) {
                header('Location: /' . ADMIN_URL . '/page/');
                exit();
            } else {
                $errors = $this->model->errors();
            }
        } else {
            $fields = $this->model->one($this->params[2]);
        }

        $this->scripts[] = 'ckeditor/ckeditor';
        $this->scripts[] = 'url_page';
        $this->scripts[] = 'ck_init';
        $this->content = View::template('page/v_edit.php', ['fields' => $fields,
            'errors' => $errors,
            'pages' => $this->model->tree(),
            'base_templates' => Template::all('base'),
            'inner_templates' => Template::all('inner')
        ]);
    }

        public function action_delete(){


            //if (isset($_POST['delete'])) {

                $this->title = 'Удалить страницу';
                $id = $this->params[2];
                $errors = [];
                $pages = null;

                if ($this->model->delete($id) === true) {
                    header('Location: /' . ADMIN_URL . '/page');
                    exit();
                } elseif ($this->model->delete($id) === false) {
                    $errors = $this->model->errors();
                } elseif (is_array($this->model->delete($id))){
                    $pages = $this->model->tree($shift = $id);
                }
                //var_dump($this->model->delete($id));
                //die;
                $this->content = View::template('page/v_delete.php', ['errors' => $errors,
                    'pages' => $pages]);
            //}


            //$this->scripts[] = 'url_page';


        }

}