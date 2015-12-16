<?php

namespace Controller\Admin;

use Core\Helpers as Helpers;
use Model\Image as Image;

class Ajax
    extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function action_upload()
    {
        $callback = 3;
        $res = Image::app()->upload($_FILES['upload']);
        $this->content = "<script>window.parent.CKEDITOR.tools.callFunction($callback, \"" . $res['path'] . "\",\"" . $res['error'] . "\");</script>";
    }


    public function render()
    {
        echo $this->content;
    }
}