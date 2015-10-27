<?php
namespace Core\Admin;

class View
{
    public static function template($filename, $values = []){

        extract($values);// превращает массив в переменные с названием их как ключи массива
        ob_start();
        include(__DIR__.'/../../View/admin/' . $filename);
        return ob_get_clean();
    }
}