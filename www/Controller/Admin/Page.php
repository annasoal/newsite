<?php

namespace Controller\Client;

use \Core\Client\View as View;


class Page extends Base
{



    public function __construct()
    {
        parent::__construct();
        //$this->left = View::template('v_left.php');
    }

    // ниже по одному методу под каждую страницу


    // контакты
    public function action_contacts()
    {
        $this->title = 'Контакты';
        $this->content = View::template('page/v_contacts.php');
    }

    // о нас
    public function action_about()
    {
        $this->title = 'О нас';
        $this->content = View::template('page/v_about.php');
    }
    // 404
    public function action_p404()
    {
        header("HTTP/1.1 404 Not Found");
        $this->title = 'Cтраница не найдена';
        $message = 'Ошибка 404.Запрашиваемая страница не найдена';

        $this->content = View::template('page/v_404.php', ['message' => $message]);
    }


}