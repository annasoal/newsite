<?php

namespace Controller\Client;

use Core\Client\View as View;
use Core\Exceptions\MyException404 as Ex404;
use Model\Page as MPage;

class Page extends Base
{


    public function __construct()
    {
        parent::__construct();
        $this->left = View::template('v_left.php');
    }

    // ниже по одному методу под каждую страницу
    public function action_page(){
        $model = MPage::app();
        $url = implode('/', $this->params);
        $page = $model->getByUrl($url);

        if($page == null){
            throw new Ex404();
             /*$this->action_p404();
            return;*/
        }

        $this->title = $page['title'];
        $this->base_template = $page['base_template'];
        $this->content = View::template('inner_templates/' . $page['inner_template'], ['page' => $page]);
    }
    // контакты


    // 404
    public function action_p404()
    {
        header("HTTP/1.1 404 Not Found");
        $this->title = 'Cтраница не найдена';
        $message = 'Ошибка 404.Запрашиваемая страница не найдена';

        $this->content = View::template('page/v_404.php', ['message' => $message]);
    }


}