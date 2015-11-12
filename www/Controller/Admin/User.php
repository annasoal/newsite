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
use Model\Image as Image;
use Model\Role as MRole;
use Model\User as MUser;


class User
    extends Base
{
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = MUser::app();
        $this->image = Image::app();
        $this->role = MRole::app();
        $this->check_access('edit_users');
    }

    public function action_all()
    {
        $this->action_page();
    }

    public function action_page()
    {
        $page = isset($this->params[2]) ? (int)$this->params[2] : 1;
        $this->title = 'Страница ' . $page;
        $users = $this->user->page($page);
        if (empty($users)) {
            header('Location: /' . ADMIN_URL . '/user/add/');;
        }
        $pages_count = $this->user->pages_count();
        $this->content = View::template('user/v_all.php', ['users' => $users,
                'pages_count' => $pages_count,
                'page' => $page,
            ]
        );
    }

    public function action_one()
    {
        $this->title = 'Пользователь';
        $id = $this->params[2];
        $user = $this->user->one($id);
        var_dump($user);
        $this->content = View::template('user/v_one.php', ['user' => $user]);
    }

    public function action_role()
    {
        $id = $this->params[2];
        $role = $this->role->one($id);
        $users = $this->user->getAllByRole($id);
        $this->title = 'Пользователи с ролью: ' . $role['role'];
        $this->content = View::template('user/v_allbyrole.php', ['users' => $users]);
    }

    // ниже по одному методу под каждую страницу

    // добавление поста
    public function action_add()
    {
        $this->title = 'Добавить пользователя';
        $fields = [];
        $errors = [];
        $roles = $this->role->all();

        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['name', 'email', 'password', 'id_role', 'role', 'datebirth']);

            $id_user = $this->user->add($fields, $_FILES['file']);
            if ($id_user != false) {
                header('Location: /' . ADMIN_URL . '/user/one/' . $id_user);
                exit();
            } else {

                $roles = $this->role->all();
                $errors = $this->user->errors();
            }
        }

        $this->content = View::template('user/v_add.php', ['fields' => $fields, 'roles' => $roles, 'errors' => $errors]);
    }


    // Редактирование поста
    public function action_edit()
    {
        $this->title = 'Редактировать пользователя';
        $id = $this->params[2];
        $errors = [];
        $roles = $this->role->all();

        if (isset($_POST['update'])) {

            $fields = Arr::extract($_POST, ['name', 'email', 'id_role', 'role', 'datebirth']);

            if ($this->user->edit($id, $fields, $_FILES['file']) !== false) {
                //die();
                header('Location: /' . ADMIN_URL . '/user/one/' . $id);
                exit();
            }
        } else {
            $fields = $this->user->one($id);
            $errors = $this->user->errors();

        }

        $this->content = View::template('user/v_edit.php', ['fields' => $fields, 'roles' => $roles, 'errors' => $errors]);

    }


    public function action_delete()
    {
        $this->title = 'Удаление пользователя';
        $id = $this->params[2];
        $return = isset($this->params[3]) ? $this->params[3] : 1;

        if (isset ($_POST['undoDelete'])) {
            header('Location: /' . ADMIN_URL . '/user/one/' . $id);
            exit;
        } elseif (isset($_POST['delete'])) {
            if ($this->user->delete($id) !== false) {
                header('Location: /' . ADMIN_URL . '/user/page/' . $return);
                exit;
            }

        }

        $this->content = View::template('user/v_delete.php', ['id_user' => $id]);
    }


}