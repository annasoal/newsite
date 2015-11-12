<?php


namespace Core;


class Arr
{
    public static function extract($array, $fields)
    {
        $final = array();

        foreach ($array as $k => $v) {
            if (in_array($k, $fields))
                $final[$k] = $v;
        }

        foreach ($fields as $field) {
            if (!isset($final[$field]))
                $final[$field] = '';
        }

        return $final;
    }
}
