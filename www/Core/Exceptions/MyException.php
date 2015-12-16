<?php
/**
 * Created by PhpStorm.
 * User: Анна
 * Date: 18.11.2015
 * Time: 21:34
 */

namespace Core\Exceptions;
//use \Core\Client\View as View;


class MyException

extends \Exception
{
    protected $message;
    protected $view;
    protected $title;
    protected $content;
    protected $template;


    public function __construct() {
        $this->title = '';
        $this->content = '';
        $this->message = '';

    }


    public function showException() {

    }



}