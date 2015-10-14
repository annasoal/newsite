<?php

namespace Model;

//use \Core\SqlDb;


class Post extends \Core\Model
{

    private static $instance;

    public static function app(){
        if(self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct(){
        parent::__construct('posts', 'id_post');
    }


    protected function validation($fields){
        $err = false;

        foreach($fields as $k => $v){
            $fields[$k] = trim($v);
            //$fields[$k] = htmlspecialchars(trim($v));

            if($fields[$k] == '' || strpos($fields[$k], '<') !== false){
                $err = true;
                return false;
            }
        }

        return $fields;
    }

    public function add($fields, $file)
    {
        $res = $this->validation($fields);

        if($res === false){
            return false;
        }

        if($_FILES['file'] != '') {
           $id_image = Image::app()->add($file);

           if($id_image === false) {
               return false;
           } else {
               $res['id_image'] = $id_image;
           }
        }

        return $this->db->insert($this->table, $res);
    }


    public function edit($id,$fields,$file)
    {
        $res = $this->validation($fields);
        array_pop($res);
        //var_dump($res);

        if($res === false){
            return false;
        }
        if($_FILES['file'] != '') {

            $id_image = Image::app()->add($file);

            if($id_image === false) {
                return false;
            } else {
                $res['id_image'] = $id_image;
            }
        }
        //var_dump($res);
        return $this->db->update('posts', $res, ' id_post=:id_post', ['id_post' => $id]);

    }

    public function delete($id)
    {

        return $this->db->delete('posts', 'id_post=:id_post', ['id_post' => $id]);

    }

}