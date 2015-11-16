<?php

namespace Controller\Admin;

use Core\Helpers as Helpers;

class Ajax
    extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function action_upload()
    {
        $callback = 3;
        $file_tmp_name = $_FILES['upload']['tmp_name'];
        $file_name = $_FILES['upload']['name'];

        $mime = exif_imagetype($file_tmp_name);

        if ($mime === false) {
            $error = "Файл не является изображением ";
            $http_path = '';
        } else {
            $name = Helpers::make_translit(pathinfo($file_name)['filename']);
            $ext = (image_type_to_extension($mime));
            $full_name = $name . $ext;
            $dir =  'images/' ;
            $j = 0;
            while(file_exists(__DIR__ . '/../../' . $dir . $full_name)){
                ++$j;
                $full_name = $name . '_' . $j . $ext;
            }


            $full_path = $dir . $full_name;

            if (move_uploaded_file($file_tmp_name, $full_path)) {
                $http_path = "/" . $full_path;
                $error = '';
            } else {
                $error = "Произошла ошибка, попробуйте еще раз";
                $http_path = '';
            }
        }
        $this->content = "<script>window.parent.CKEDITOR.tools.callFunction($callback, \"" . $http_path . "\",\"" . $error . "\");</script>";




    }


    public function render()
    {
        echo $this->content;
    }
}

