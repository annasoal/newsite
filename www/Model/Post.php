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
                                  LEFT JOIN posts_tags using(id_post)
                                  LEFT JOIN tags using(id_tag)
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

        $id_post = $this->db->insert($this->table, $res);

        if (count($tags) > 0) {
            foreach ($tags as $key=>$tag) {
                $this->db->insert('posts_tags', ['id_post' =>$id_post, 'id_tag' => $tag]);
            }
        }
        return $id_post;
    }


    public function edit($id, $fields, $file)
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

        return $this->db->update($this->table, $res, ' id_post=:id_post', ['id_post' => $id]);
    }

    public function getAllByTag($id_tag)
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  JOIN posts_tags using(id_post)
                                  JOIN tags using(id_tag)
                                  WHERE id_tag=:id_tag", ['id_tag' => $id_tag]);
    }
    public function getOneByTag($id_post)
    {
        return $this->db->select("SELECT * FROM {$this->table}
                                  LEFT JOIN posts_tags using(id_post)
                                  LEFT JOIN tags using(id_tag)
                                  WHERE id_post=:id_post", ['id_post' => $id_post]);
    }

}