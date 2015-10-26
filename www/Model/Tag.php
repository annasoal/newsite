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


        $tmp = $this->db->select("SELECT id_tag, id_post, name FROM `posts_tags`
                                  LEFT JOIN {$this->table} using(id_tag)
                                  WHERE id_post IN($id_post)");
        $res = [];

        foreach($tmp as $one){
            if($res[$one['id_post']] == null){
                $res[$one['id_post']] = [];
            }
            $res[$one['id_post']][] = $one;
        }

        return $res;

    }
    public function getIdTagsForOne($id_post){


        $tmp = $this->db->select("SELECT id_tag,id_post FROM `posts_tags`
                                  LEFT JOIN {$this->table} using(id_tag)
                                  WHERE id_post IN($id_post)");
        $res = [];

        foreach($tmp as $one){
            if($res[$one['id_post']] == null){
                $res[$one['id_post']] = [];
            }
            $res[$one['id_post']][] = $one;
        }
        var_dump($res);
        foreach ($res as $key=>$el) {
            foreach ($el as $k=>$v)
            $resF[$k] = $v['id_tag'];
        }
        return($resF);

    }
    public function deleteTagsForOne($id_post){

    return $this->db->delete('posts_tags', "id_post=:id_post", ['id_post' => $id_post]);


    }

}