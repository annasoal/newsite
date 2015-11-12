<?php

namespace Model;


class Priv extends \Core\Model
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
        parent::__construct('privs', 'id_priv');
    }

    public function getPrivsForAll($roles_id)
    {

        if (empty($roles_id))
            return [];

        $in = implode(', ', $roles_id);
        $tmp = $this->db->select("SELECT id_priv, id_role, name FROM `roles_privs`
                                  LEFT JOIN {$this->table} using(id_priv)
                                  WHERE id_role IN ($in)");
        $res = [];

        foreach ($tmp as $one) {
            if ($res[$one['id_role']] == null) {
                $res[$one['id_role']] = [];
            }
            $res[$one['id_role']][] = $one;
        }

        return $res;

    }

    public function getPrivsForOne($id_role)
    {
        return $this->db->select("SELECT id_priv, id_role, name FROM `roles_privs`
                                  LEFT JOIN {$this->table} using(id_priv)
                                  WHERE id_role=:id_role", ['id_role' => $id_role]);
    }

    public function getIdPrivsForOne($id_role)
    {
        $res = $this->getPrivsForOne($id_role);
        $privs_id = [];

        foreach ($res as $key => $el) {
            $privs_id[] = $el['id_priv'];
        }

        return ($privs_id);
    }


}