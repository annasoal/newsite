<?php
/**
 * Created by PhpStorm.
 * User: Анна
 * Date: 01.11.2015
 * Time: 20:44
 */

namespace Controller\Admin;

use Core\Arr as Arr;
use Core\Admin\View as View;
use Model\Image as Image;
use Model\User as MUser;
use Model\Role as MRole;



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

    }
    public function action_all(){
        $this->action_page();
    }

    public function action_page()
    {
        $page = isset($this->params[2]) ? (int)$this->params[2] : 1;
        $this->title = 'Страница ' . $page;
        $users = $this->user->page($page);
        $users_id = [];

        foreach($users as $one)
            $users_id[] = $one['id_user'];
        // 74, 75, ///, 78
        $roles = $this->role->getRolesForAll($users_id);
        if (empty($users_id)) {
            $this->action_add();
        }
        $pages_count = $this->user->pages_count();
        $this->content = View::template('user/v_all.php', ['users' => $users,
                'pages_count' => $pages_count,
                'page' => $page,
                'roles' => $roles]
        );
    }

    public function action_one()
    {
        $this->title = 'Пользователь';
        $id = $this->params[2];
        $user = $this->user->one($id);
        $roles = $this->role->getRolesForOne($id);
        $this->content = View::template('user/v_one.php', ['user' => $user,'roles' => $roles]);
    }
    public function action_role()
    {
        $id = $this->params[2];
        $role = $this->role->one($id);
        $users = $this->user->getAllByRole($id);

        $this->title = 'Пользователи с ролью: ' . $role['name'];
        $users_id = [];

        foreach($users as $one)
            $users_id[] = $one['id_user'];
        // 74, 75, ///, 78
        $roles = $this->role->getRolesForAll($users_id);

        $this->content = View::template('user/v_allbyroles.php', ['users' => $users, 'roles' => $roles ]);
    }



    // ниже по одному методу под каждую страницу

    // добавление поста
    public function action_add()
    {
        $this->title = 'Добавить пользователя';
        $fields = ['name' => '', 'roles' => []];
        $errors =[];
        $roles = $this->role->all();

        if (isset($_POST['add'])) {
            $fields = Arr::extract($_POST, ['name', 'email', 'password', 'datebirth']);

            $roles = $_POST['roles'];
            $id_user = $this->user->add($fields, $roles, $_FILES['file']);
            if ( $id_user!= false) {
                header('Location: /admin/user/one/' . $id_user);
                exit();
            } else {

                $fields['roles'] = $roles;
                $roles = $this->role->all();
                $errors = $this->user->errors();
            }
        }

        $this->content = View::template('user/v_add.php', ['fields' => $fields,'roles' => $roles,'errors' =>$errors]);
    }



    // Редактирование поста
    public function action_edit()
    {
        $this->title = 'Редактировать пользователя';
        $id = $this->params[2];
        $errors =[];
        $roles = $this->role->all();

        if (isset($_POST['update'])) {

            $fields = Arr::extract($_POST, ['name', 'email','password', 'datebirth']);

            $roles = $_POST['roles'];
            if ($this->user->edit($id, $fields, $roles, $_FILES['file']) !== false) {
                //die();
                header('Location: /admin//user/one/' . $id);
                exit();
            }
        } else {
            $fields = $this->user->one($id);

            $fields['roles'] = $this->role->getIdRolesForOne($id);
            $errors = $this->user->errors();

        }

        $this->content = View::template('user/v_edit.php', ['fields' => $fields, 'roles' => $roles,'errors' =>$errors]);

    }


    public function action_delete()
    {
        $this->title = 'Удаление пользователя';
        $id = $this->params[2];
        $return = isset($this->params[3]) ? $this->params[3] : 1;

        if (isset ($_POST['undoDelete'])) {
            header('Location: /admin/user/one/' . $id);
            exit;
        } elseif (isset($_POST['delete'])) {
            if ($this->user->delete($id) !== false) {
                header('Location: admin/user/page/' . $return);
                exit;
            }

        }

        $this->content = View::template('user/v_delete.php', ['id_user' => $id]);
    }

}