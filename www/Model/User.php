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
                                  LEFT JOIN images using(id_image) ORDER BY date DESC");
    }

    public function page($page)
    {
        $on_page = 5;
        $shift = ($page - 1) * $on_page;

        return $this->db->select("SELECT * FROM {$this->table}
                                  LEFT JOIN images using(id_image)
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
                                  WHERE {$this->pk}=:{$this->pk}",
            [$this->pk => $id])[0];
    }

    protected function validation($fields)
    {
        $err = false;

        foreach ($fields as $k => $v) {
            $fields[$k] = trim($v);

            if ($fields[$k] == '' || strpos($fields[$k], '<') !== false) {
                $err = true;
                return false;
            }
        }

        return $fields;
    }

    public function add($fields, $roles, $file)
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

        if ($id_user != false) {
            if (count($roles) > 0) {
                foreach ($roles as $key => $id_role) {
                    $this->db->insert('users_roles', ['id_user' => $id_user, 'id_role' => $id_role]);
                }
            }
        } elseif ($id_user == false && $id_image != null) {
            Image::app()->delete($id_image);
        }
        return $id_user;
    }

    public function edit($id, $fields, $roles, $file)
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
        if ($res != false) {
            $this->db->delete('users_roles', 'id_user=:id_user', ['id_user' => $id]);

            if (count($roles) > 0) {
                foreach ($roles as $key => $id_role) {
                    $this->db->insert('users_roles', ['id_user' => $id, 'id_role' => $id_role]);
                }
            }
        } elseif ($res == false && $id_image != null) {
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
            $this->db->delete('users_roles', 'id_user=:id_user', ['id_user' => $id]);

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
                                  JOIN users_roles using(id_role)
                                  JOIN roles using(id_role)
                                  WHERE id_role=:id_role", ['id_role' => $id_role]);
    }


}
