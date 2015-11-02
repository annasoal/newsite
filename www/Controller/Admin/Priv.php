<?php


namespace Controller\Admin;

use Core\Arr as Arr;
use Core\Admin\View as View;
use Model\Priv as MPriv;


class Priv
    extends Base
{
    private $priv;
    private $template;

    public function __construct()
    {
        parent::__construct();
        $this->priv = MPriv::app();
        $this->template = 'priv/v_privs.php';
    }


    public function action_all()
    {
        $privs = $this->priv->all();
        $this->content = View::template($this->template, ['privs' => $privs]);
    }


    public function action_add()
    {
        $privs = $this->priv->all();
        $errors =[];
        $fields = ['name' => ''];
        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['name', 'description']);
            if ($this->priv->add($fields)) {
                header('Location: admin/priv/all');
                exit();
            } else {
                 $errors = $this->priv->errors();
            }
        }

        $this->content = View::template($this->template, ['fields' => $fields, 'errors' =>$errors, 'privs'=>$privs]);
    }


    // Редактирование
    public function action_edit()
    {
        $this->title = "Редактирование привилегии";
        $errors =[];
        $id = $this->params[2];

        if (isset($_POST['update'])) {
            $fields = Arr::extract($_POST, ['name', 'description']);

            if ($this->priv->edit($id, $fields) !== false) {
                header('Location: /admin/priv/all');
                exit();
            } else {
                $errors = $this->priv->errors();
            }

        } else {
            $fields = $this->priv->one($id);
        }

        $this->content = View::template('priv/v_edit.php', ['fields' => $fields, 'errors' =>$errors]);
    }


    public function action_delete()
    {
        $this->title = 'Удаление роли';
        $id = $this->params[2];

        if (isset ($_POST['undoDelete'])) {
            header('Location: /admin/priv/all');
            exit;

        } elseif (isset($_POST['delete'])) {
            if ($this->priv->delete($id) !== false) {
                header('Location: /admin/priv/all');
                exit;
            }

        }

        $this->content = View::template('priv/v_delete.php', ['id_priv' => $id]);
    }

}