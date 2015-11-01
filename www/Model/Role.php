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






}