<?php
namespace Core\Client;

class View
{
    public static function template($filename, $values = [])
    {

        extract($values);// превращает массив в переменные с названием их как ключи массива
        ob_start();
        include(__DIR__ . '/../../View/client/' . $filename);
        return ob_get_clean();
    }
}