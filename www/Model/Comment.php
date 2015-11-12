<?php

namespace Model;

class Comment extends \Core\Model
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
        parent::__construct('comments', 'id_comment');
    }

    public function getByPost($id_post)
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  LEFT JOIN users USING (id_user)
                                  WHERE id_post=:id_post",
            ['id_post' => $id_post]
        );
    }
}