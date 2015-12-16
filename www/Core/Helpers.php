<?php

namespace Core;

class Helpers
{
    private static $texts = null;

    public static function make_translit($str){

        $converter = [
            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'kh',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'shch',

            'ь' => '',    'ы' => 'y',   'ъ' => '',

            'э' => 'eh',  'ю' => 'yu',  'я' => 'ya',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'Yo',  'Ж' => 'Zh',  'З' => 'Z',

            'И' => 'I',   'Й' => 'Y',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'Kh',  'Ц' => 'C',

            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Shch',

            'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',

            'Э' => 'Eh',  'Ю' => 'Yu',  'Я' => 'Ya',

            '_' =>'-',

        ];

        return strtolower(strtr($str, $converter));
    }

    public static function text($name){
        if(self::$texts === null){
            $all = \Model\Text::app()->all();
            self::$texts = [];

            foreach($all as $one)
                self::$texts[$one['name']] = $one['text'];
        }

        return self::$texts[$name];
    }
}