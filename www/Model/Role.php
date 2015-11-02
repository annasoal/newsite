<?php
/**
 * Created by PhpStorm.
 * User: Анна
 * Date: 01.11.2015
 * Time: 21:32
 */

namespace Model;


class Role

 extends \Core\Model
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
        parent::__construct('roles', 'id_role');
    }

    public function page($page)
    {
        $on_page = 5;
        $shift = ($page - 1) * $on_page;

        return $this->db->select("SELECT * FROM {$this->table}
                                  LIMIT $shift,$on_page
                                  ");
    }

    public function pages_count()
    {
        $res = $this->db->select("SELECT count(*) as cnt FROM {$this->table}");
        return ceil($res[0]['cnt'] / 5);
    }

    public function add($fields, $privs)
    {
        $res = $fields;
        $id_role = parent::add($res);
        if ($id_role != false) {
            if (count($privs) > 0) {
                foreach ($privs as $key => $id_priv) {
                    $this->db->insert('roles_privs', ['id_role' => $id_role, 'id_priv' => $id_priv]);
                }
            }
        } else return false;

        return $id_role;
    }

    public function edit($id, $fields, $privs)
    {

        $res = parent::edit($id, $fields);
        if ($res != false) {
            $this->db->delete('roles_privs', 'id_role=:id_role', ['id_role' => $id]);

            if (count($privs) > 0) {
                foreach ($privs as $key => $id_priv) {
                    $this->db->insert('roles_privs', ['id_role' => $id, 'id_priv' => $id_priv]);
                }
            }
        }
        return $res;
    }

    public function delete($id)
    {
       $res = parent::delete($id);

        if ($res === false) {
            return false;
        } else {
            $this->db->delete('roles_privs', 'id_role=:id_role', ['id_role' => $id]);

        }


        return true;
    }


    public function getRolesForAll($users_id){

        if(empty($users_id))
            return [];

        $in = implode(', ', $users_id);
        $tmp = $this->db->select("SELECT id_role, id_user, name FROM `users_roles`
                                  LEFT JOIN {$this->table} using(id_role)
                                  WHERE id_user IN ($in)");
        $res = [];

        foreach($tmp as $one){
            if($res[$one['id_user']] == null) {
                $res[$one['id_user']] = [];
            }
            $res[$one['id_user']][] = $one;
        }

        return $res;

    }
    public function getRolesForOne($id_user){
        return $this->db->select("SELECT id_role, id_user, name FROM `users_roles`
                                  LEFT JOIN {$this->table} using(id_role)
                                  WHERE id_user=:id_user", ['id_user' => $id_user]);
    }
    public function getIdRolesForOne($id_user){
        $res = $this->getRolesForOne($id_user);
        $roles_id = [];

        foreach($res as $key => $el){
            $roles_id[] = $el['id_role'];
        }

        return($roles_id);
    }


    public function getAllByPriv($id_priv)
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  JOIN roles_privs using(id_priv)
                                  JOIN privs using(id_priv)
                                  WHERE id_priv=:id_priv", ['id_priv' => $id_priv]);
    }




}