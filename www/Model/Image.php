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
        $res = $this->upload($file);

        if ($res['res'] === false) {
            return false;
        } else {
            return $this->db->insert($this->table, ['file' => $res['path']]);
        }
    }


    public function upload($file)
    {
        $out = ['res' => false, 'error' => '', 'path' => '', 'ext' => ''];

        if (is_uploaded_file($file['tmp_name'])){
            $file_tmp_name = $file['tmp_name'];
            $file_name = $file['name'];

            $mime = exif_imagetype($file_tmp_name);

            if ($mime === false) {
                $out['error'] = "Файл не является изображением " . $mime;
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
                    $out['res'] = true;
                    $out['path'] = $full_path;
                    $out['ext'] = $ext;
                } else {
                    $out['error'] = "Произошла ошибка, попробуйте еще раз";
                }
            }
        }
        else{
            $out['error'] = "Сервер отклюнил картинку";
        }

        return $out;
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
    public function upload_base64($name, $value)
    {
        if(!$this->check_type($name))
            return false;

        $getMime = explode('.', $name);
        $mime = strtolower(end($getMime));
        $filename = mt_rand(0, 10000000) . '.' . $mime;

        while(file_exists('images/' . $filename))
            $filename = mt_rand(0, 10000000) . '.' . $mime;

        // Выделим данные
        $data = explode(',', $value);

        // Декодируем данные, закодированные алгоритмом MIME base64
        $encodedData = str_replace(' ', '+', $data[1]);
        $decodedData = base64_decode($encodedData);

        file_put_contents('images/' . $filename, $decodedData);
        // exif_imagetype, если === false unlink return false

        return $this->db->insert($this->table, ['file' => '/images/' . $filename]);
    }

    //
    // Редактирование изображения
    //

    private function check_type($name)
    {
        // Получаем расширение файла
        $getMime = explode('.', $name);
        $mime = strtolower(end($getMime));
        $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
        return in_array($mime, $types);
    }
}
