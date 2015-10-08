<?php
abstract class C_Base
{
    // поля базового шаблона
    protected $title;
    protected $content;
    protected $left;

    // всё, что до
    public function __construct(){
        $this->title = '';
        $this->content = '';
        $this->left = '';
    }

    // всё, что после
    public function render(){
        $main = M_View::template('v_main.php', ['title' => $this->title, 'content' => $this->content, 'left' => $this->left]);
        echo $main;
    }
}