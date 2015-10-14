<?php

namespace Model;


class Tag extends \Core\Model
{

    private static $instance;

    public static function app(){
        if(self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct(){
        parent::__construct('tags', 'id_tag');
    }

    public function add($file){
        // валидация
        // move_uploaded

        return $this->db->insert($this->table, ['path' => $file['name']]);
    }

    /* protected function validation($fields){

    } */
}