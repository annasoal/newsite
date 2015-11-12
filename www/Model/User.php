<?php

namespace Model;

class User extends \Core\Model
{
    private static $instance;

    public static function app()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
        parent::__construct('users', 'id_user');

    }

    public function all()
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  LEFT JOIN images using(id_image)
                                  JOIN roles using(id_role)");
    }

    public function page($page)
    {
        $on_page = 5;
        $shift = ($page - 1) * $on_page;

        return $this->db->select("SELECT * FROM {$this->table}
                                  LEFT JOIN images using(id_image)
                                  JOIN roles using(id_role)
                                  LIMIT $shift,$on_page
                                  ");
    }

    public function pages_count()
    {
        $res = $this->db->select("SELECT count(*) as cnt FROM {$this->table}");
        return ceil($res[0]['cnt'] / 5);
    }

    public function one($id)
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  LEFT JOIN images using(id_image)
                                  LEFT JOIN roles using(id_role)
                                  WHERE {$this->pk}=:{$this->pk}",
            [$this->pk => $id])[0];
    }

    public function getByLogin($email)
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  WHERE email=:email", ['email' => $email])[0];

    }


    public function add($fields, $file)
    {
        $res = $fields;
        if ($file['name'] != '') {
            $id_image = Image::app()->add($file);
            if ($id_image === false) {
                return false;
            } else {
                $res['id_image'] = $id_image;
            }
        }
        $id_user = parent::add($res);

        if ($id_user == false && $id_image != null) {
            Image::app()->delete($id_image);
        }
        return $id_user;
    }

    public function edit($id, $fields, $file)
    {
        if ($file['name'] != '') {
            $id_image = Image::app()->add($file);

            if ($id_image === false) {
                return false;
            } else {
                $fields['id_image'] = $id_image;
            }
        }
        $res = parent::edit($id, $fields);
        if ($res == false && $id_image != null) {
            Image::app()->delete($id_image);
        }
        return $res;
    }

    public function delete($id)
    {
        $user = $this->one($id);
        $id_image = $user['id_image'];
        $file = $user['file'];
        $res = parent::delete($id);

        if ($res === false) {
            return false;
        } else {

            if ($file != null) {
                if (Image::app()->delete($id_image) === true) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    public function getAllByRole($id_role)
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  LEFT JOIN images using(id_image)
                                  JOIN roles using(id_role)
                                  WHERE id_role=:id_role", ['id_role' => $id_role]);
    }

    public function getPrivs($id_user)
    {
        $res = $this->db->select("SELECT privs.name FROM {$this->table}
                                  JOIN roles_privs using(id_role)
                                  JOIN privs using(id_priv)
                                  WHERE id_user=:id_user", ['id_user' => $id_user]);

        $privs = [];

        foreach ($res as $one)
            $privs[] = $one['name'];

        return $privs;
    }
}
