<?php
class M_Post
{


    public static function all(){
        return file('data/text.txt');
    }

    public static function one($id){
        $posts = file('data/text.txt');
        return $posts[$id];
    }

    public function add($text){
        $text = trim($text);

        if($text == '')
            return false;

        $date = date("Y:m:d H-i-s");
        file_put_contents('data/text.txt', "$date: $text \n", FILE_APPEND);
        return true;
    }

    public function editForm($id){

        $eText =  explode(' ',$this->one($id));

        return $eText;

    }


    public function edit($text,$id){

        $text = trim($text);

        if($text == '')
            return false;

        $date = $this->editForm($id)[0] . ' ' . $this->editForm($id)[1] . ' ';

        file_put_contents('data/text.txt', $date .  $text .  "\n");
        return true;
    }


}