<?php
/**
 * Created by PhpStorm.
 * User: Анна
 * Date: 01.11.2015
 * Time: 20:44
 */

namespace Controller\Admin;

use Core\Admin\View as View;
use Core\Arr as Arr;
use Model\Priv as MPriv;
use Model\Role as MRole;


class Role
    extends Base
{

    public function __construct()
    {
        parent::__construct();
        $this->priv = MPriv::app();
        $this->role = MRole::app();
    }

    public function action_all(){
        $this->action_page();
    }
    public function action_page()
    {
        $page = isset($this->params[2]) ? (int)$this->params[2] : 1;
        $this->title = 'Страница ' . $page;
        $roles = $this->role->page($page);
        $roles_id = [];

        foreach($roles as $one)
            $roles_id[] = $one['id_role'];
        // 74, 75, ///, 78
        $privs = $this->priv->getPrivsForAll($roles_id);

        $pages_count = $this->role->pages_count();
        $this->content = View::template('role/v_all.php', ['roles' => $roles,
                'pages_count' => $pages_count,
                'page' => $page,
                'privs' => $privs]
        );
    }



    public function action_one()
    {
        $this->title = 'Роль';
        $id = $this->params[2];
        $role = $this->role->one($id);
        $privs = $this->priv->getPrivsForOne($id);
        $this->content = View::template('role/v_one.php', ['role' => $role, 'privs' => $privs]);
    }

    public function action_priv()
    {
        $id = $this->params[2];
        $priv = $this->priv->one($id);
        $roles = $this->role->getAllByPriv($id);

        $this->title = 'Роли с привилегией: ' . $priv['name'];
        $roles_id = [];

        foreach ($roles as $one)
            $roles_id[] = $one['id_role'];
        // 74, 75, ///, 78
        $privs = $this->priv->getPrivsForAll($roles_id);

        $this->content = View::template('role/v_allbyprivs.php', ['roles' => $roles, 'privs' => $privs]);
    }



    // ниже по одному методу под каждую страницу

    // добавление поста
    public function action_add()
    {
        $this->title = 'Добавить роль';
        $fields = ['name' => '', 'privs' => []];
        $errors = [];
        $privs = $this->priv->all();

        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['name', 'description']);

            $privs = $_POST['privs'];
            $id_role = $this->role->add($fields, $privs);
            if ($id_role != false) {
                header('Location: /admin/role/one/' . $id_role);
                exit();
            } else {

                $fields['privs'] = $privs;
                $privs = $this->priv->all();
                $errors = $this->role->errors();
            }
        }

        $this->content = View::template('role/v_add.php', ['fields' => $fields, 'privs' => $privs, 'errors' => $errors]);
    }


    // Редактирование поста
    public function action_edit()
    {
        $this->title = 'Редактировать роль';
        $id = $this->params[2];
        $errors = [];
        $privs = $this->priv->all();

        if (isset($_POST['update'])) {
            $fields = Arr::extract($_POST, ['name', 'description']);
            $privs = $_POST['privs'];
            if ($this->role->edit($id, $fields, $privs) !== false) {
                //die();
                header('Location: /admin/role/one/' . $id);
                exit();
            }
        } else {

            $fields = $this->role->one($id);
            $fields['privs'] = $this->priv->getIdPrivsForOne($id);;
            $errors = $this->role->errors();
        }

        $this->content = View::template('role/v_edit.php', ['fields' => $fields, 'privs' => $privs, 'errors' => $errors]);

    }


    public function action_delete()
    {
        $this->title = 'Удаление роли';
        $id = $this->params[2];

        if (isset ($_POST['undoDelete'])) {
            header('Location: /admin/role/one/' . $id);
            exit;
        } elseif (isset($_POST['delete'])) {
            if ($this->role->delete($id) !== false) {
                header('Location: /admin/role/all');
                exit;
            }

        }

        $this->content = View::template('role/v_delete.php', ['id_role' => $id]);
    }

}