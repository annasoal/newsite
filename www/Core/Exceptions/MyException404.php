<?php
/**
 * Created by PhpStorm.
 * User: Анна
 * Date: 18.11.2015
 * Time: 21:35
 */

namespace Core\Exceptions;

use \Core\Client\View as View;



class MyException404
    extends MyException
{


    public function __construct() {

        $this->message = 'Ошибка 404.Запрашиваемая страница не найдена';
        $this->template = 'base_templates/v_excep.php';
    }


    public function showException() {

        header("HTTP/1.1 404 Not Found");
        $this->title = 'Страница не найдена';
        $this->content = View::template('exceptions/v_404.php', ['message' => $this->message]);
        $this->view =  View::template($this->template, ['title' => $this->title, 'content' => $this->content]);
        echo $this->view;

    }


}