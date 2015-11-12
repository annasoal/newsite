<?php

namespace Controller\Admin;

use Core\Admin\View as View;


class Msg extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function action_access_err()
    {
        $this->title = 'Ошибка доступа';
        $this->content = View::template('msg/v_accessdenied.php');
    }
}