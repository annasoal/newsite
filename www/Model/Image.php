<?php
/**
 * Created by PhpStorm.
 * User: Анна
 * Date: 14.10.2015
 * Time: 13:19
 */

namespace Model;


class Image extends \Core\Model
{

    private static $instance;

    public static function app(){
        if(self::$instance == null){
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct(){
        parent::__construct('images', 'id_image');
    }

    public function add($file)
    {


        $res = $this->validation($file);
        //var_dump($res);
        if ( $res === false) {
            return false;
        } else {
            return $this->db->insert($this->table, ['file' => $res]);
        }
    }


    protected function validation($file){

        $newFilename = __DIR__ . '/../images/' . basename($_FILES['file']['name']);
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            move_uploaded_file($_FILES['file']['tmp_name'], $newFilename);
            return '/images/' . basename($_FILES['file']['name']);
            //что делать если название сайта русскими буквами???
        } else {
        return false;
        }
    }
    public function delete ($id)
    {
        $file = $this->one($id)['file'];
        $res = parent::delete($id);

        if ($res !== false) {
            unlink(__DIR__ . '/../' . $file);
            $res = true;
        } else {
            $res = false;
        }
        return $res;
    }

}
