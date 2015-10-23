<?php

namespace Model;

use \Core\Arr;


class Post extends \Core\Model
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
        parent::__construct('posts', 'id_post');
    }

    public function all()
    {
        return $this->db->select("SELECT * FROM {$this->table} 
                                  LEFT JOIN images using(id_image) ORDER BY date DESC");
    }

    public function page($page) {
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
            //$fields[$k] = htmlspecialchars(trim($v));

            if ($fields[$k] == '' || strpos($fields[$k], '<') !== false) {
                $err = true;
                return false;
            }
        }

        return $fields;
    }

    public function add($fields, $tags, $file)
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

        $id_post = parent::add($res);

        if ($id_post != false) {
            if (count($tags) > 0 ) {
                foreach ($tags as $key=>$tag) {
                    $this->db->insert('posts_tags', ['id_post' =>$id_post, 'id_tag' => $tag]);
                }
            }
        } elseif($id_post == false && $id_image != null) {
            Image::app()->delete($id_image);
        }
        return $id_post;
    }
   /* public function add($fields, $file){
        $mImages = Images::app();

        if(($id_image = $mImages->add($file)) === false){
            $this->errors = $mImages->errors();
            return false;
        }

        $fields['id_image'] = $id_image;
        $res = parent::add($fields);

        if(!$res){
            //$mImages->delete($id_image);
            return false;
        }

        return $res;
    }*/


    public function edit($id, $fields, $tags, $file)
    {
        $res = $this->validation($fields);

        if ($res === false) {
            return false;
        }

        if ($file['name'] != '') {
            $id_image = Image::app()->add($file);

            if ($id_image === false) {
                return false;
            } else {
                $res['id_image'] = $id_image;
            }
        }
        if (count($tags) > 0) {
            foreach ($tags as $key=>$tag) {
                $this->db->insert('posts_tags', ['id_post' =>$id, 'id_tag' => $tag]);
            }
        }

        return $this->db->update($this->table, $res, ' id_post=:id_post', ['id_post' => $id]);
    }
    public function delete($id)
    {
        $post = $this->one($id);
        //var_dump($post);
        $id_image = $post['id_image'];
        $file = $post['file'];
        $resP = $this->db->delete($this->table, ' id_post=:id_post', ['id_post' => $id]);

        if ($resP === false) {
            return false;
        } elseif ($file != null) {
            if(Image::app()->delete($id_image) ===true) {
                return true;
            } else {
                return false;
            }
        }

        return true;
    }

    public function getAllByTag($id_tag)
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  LEFT JOIN images using(id_image)
                                  JOIN posts_tags using(id_post)
                                  JOIN tags using(id_tag)
                                  WHERE id_tag=:id_tag", ['id_tag' => $id_tag]);
    }



}