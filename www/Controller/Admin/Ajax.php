<?php

namespace Controller\Admin;

class Ajax extends Base
{
    public function __construct(){
        parent::__construct();
    }

    public function action_upload(){
        $callback = 3;
		$file_name = $_FILES['upload']['name'];
		
		$getMime = explode('.', $file_name);
		$mime = end($getMime);
		
		$types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');
		
        if(!in_array($mime, $types)){
			$error = "Расширение файла не подходит";
			$http_path = '';
		}
		else{
			$file_name = substr_replace(sha1(microtime(true)), '', 12).'.'.$mime;	
			
			$file_name_tmp = $_FILES['upload']['tmp_name'];
			$file_new_name = 'images/';
			$full_path = $file_new_name . $file_name;
			
			if(copy($file_name_tmp, $full_path)){
				$http_path = "/".$full_path;
				$error = '';
			}
			else
			{
				$error = "Произошла ошибка, попробуйте еще раз";
				$http_path = '';
			}
		}
		$this->content = "<script>window.parent.CKEDITOR.tools.callFunction($callback, \"".$http_path."\",\"".$error."\");</script>";
    }
    
    public function render(){
        echo $this->content;
    }
}