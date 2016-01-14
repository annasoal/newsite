<?php

namespace Model;


class Gallery extends \Core\Model
{

    private static $instance;

    public static function app()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct(){
        parent::__construct('galleries', 'id_gallery');
    }
    
    public function add_image($id_gallery, $id_image){
        // SELECT MAX(num_sort) FROM galleries_images WHERE $id_gallery, $id_image
    
        $this->db->insert('galleries_images', ['id_gallery' => $id_gallery, 'id_image' => $id_image]);
        return true;
    }
}