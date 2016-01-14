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

    public function action_gallery_upload()
    {
        $this->check_access('edit_posts');
        $id_image = Image::app()->upload_base64($_POST['name'], $_POST['value']);

        if($id_image != false){
            Gallery::app()->add_image($_POST['id_gallery'], $id_image);
            $this->content = $_POST['name'] . ':1';
        }
        else{
            $this->content = $_POST['name'] . ':0';
        }
    }
    public function render()
    {
        echo $this->content;
    }
}