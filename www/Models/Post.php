<?php

namespace Models;

use \Core\SqlDb;


class Post
{


    public static function all()
    {
        return SqlDb::app()->select('SELECT * FROM posts ORDER BY date_post DESC');
    }

    public static function one($id)
    {

        return SqlDb::app()->select('SELECT * FROM posts WHERE id_post=:id_post', ['id_post' => $id])[0];
    }

    public function add($titlePost, $textPost, $filename, $imgDescriptionPost)
    {

        $titlePost = trim($titlePost);
        $textPost = trim($textPost);
        $imgFilePost = '/../images/' . pathinfo($filename)['basename'];
        $imgDescriptionPost = trim($imgDescriptionPost);

        if ($titlePost == '' || $textPost == '' || $imgFilePost == '' || $imgDescriptionPost == '') {
            return false;
        }

        return $id = SqlDb::app()->insert('posts', ['title_post' => $titlePost,
                'text_post' => $textPost,
                'imgFile_post' => $imgFilePost,
                'imgDescription_post' => $imgDescriptionPost]
        );

    }

    public function edit($id, $titlePost, $textPost)
    {

        $titlePost = trim($titlePost);
        $textPost = trim($textPost);
        //var_dump($titlePost);

        //var_dump($id);

        if ($titlePost == '' || $textPost == '') {
            return false;
        }

        return SqlDb::app()->update('posts', ['title_post' => $titlePost,
            'text_post' => $textPost], ' id_post=:id_post', ['id_post' => $id]);

    }

    public function delete($id)
    {

        return SqlDb::app()->delete('posts', 'id_post=:id_post', ['id_post' => $id]);

    }

}