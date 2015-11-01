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

    public function getTagsForAll($posts_id){

        if(empty($posts_id))
            return [];

        $in = implode(', ', $posts_id);
        $tmp = $this->db->select("SELECT id_tag, id_post, name FROM `posts_tags`
                                  LEFT JOIN {$this->table} using(id_tag)
                                  WHERE id_post IN ($in)");
        $res = [];

        foreach($tmp as $one){
            if($res[$one['id_post']] == null) {
                $res[$one['id_post']] = [];
            }
            $res[$one['id_post']][] = $one;
        }

        return $res;

    }
    public function getTagsForOne($id_post){
        return $this->db->select("SELECT id_tag, id_post, name FROM `posts_tags`
                                  LEFT JOIN {$this->table} using(id_tag)
                                  WHERE id_post=:id_post", ['id_post' => $id_post]);
    }
    public function getIdTagsForOne($id_post){
        $res = $this->getTagsForOne($id_post);
        $tags_id = [];

        foreach($res as $key => $el){
            $tags_id[] = $el['id_tag'];
        }

        return($tags_id);
    }



}