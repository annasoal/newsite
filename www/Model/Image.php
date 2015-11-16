<?php

namespace Model;

use \Core\Helpers as Helpers;

class Image extends \Core\Model
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
        parent::__construct('images', 'id_image');
    }

    public function add($file)
    {


        $res = $this->validation($file);
        //var_dump($res);
        if ($res === false) {
            return false;
        } else {
            return $this->db->insert($this->table, ['file' => $res]);
        }
    }


    protected function validation($file)
    {
        if (is_uploaded_file($_FILES['file']['tmp_name'])) {

            $file_tmp_name = $_FILES['file']['tmp_name'];
            $file_name = $_FILES['file']['name'];

            $mime = exif_imagetype($file_tmp_name);

            if ($mime === false) {
                $error = "Файл не является изображением " . $mime;
                $http_path = '';
            } else {
                $name = Helpers::make_translit(pathinfo($file_name)['filename']);
                $dir ='/images/';
                $ext = (image_type_to_extension($mime));
                $full_name = $name . $ext;
                $dir =  '/images/' ;
                $j = 0;
                while(file_exists(__DIR__ . '/..' . $dir . $full_name)){
                    ++$j;
                    $full_name = $name . '_' . $j . $ext;
                }


                $full_path = $dir . $full_name;

                if (move_uploaded_file($file_tmp_name, __DIR__ . '/..' .$full_path)) {
                    $http_path = $full_path;
                    $error = '';
                } else {
                    $error = "Произошла ошибка, попробуйте еще раз";
                    $http_path = '';
                }

            }
            return $http_path;
        } else {
                return false;
            }

    }

    public function delete($id)
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
