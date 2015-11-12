<?php

namespace Controller\Admin;

use Core\Arr as Arr;
use Core\Auth as Auth;
use Core\Admin\View as View;
use Model\Page as MPage;

class Page extends Base
{
    private $model;

    public function __construct(){
        parent::__construct();
        $this->model = MPage::app();
    }

    public function action_index()
        {
            $pages = $this->model->tree();
            $this->content = View::template('v_index.php', ['pages'=> $pages]);
        }



    public function action_add()
    {
        $this->title = 'Добавить страницу';
        $fields = [];
        $errors =[];

        if (isset($_POST['add'])){
            $fields = Arr::extract($_POST, ['id_parent', 'url', 'title', 'content']);
            $id = $this->model->add($fields);

            if ($id != false) {
                header('Location: /' . ADMIN_URL . '/page/');
                exit();
            } else {
                $errors = $this->model->errors();
            }
        }

        $this->content = View::template('page/v_add.php', ['fields' => $fields, 'errors' =>$errors, 'pages' => $this->model->tree()]);
    }

}