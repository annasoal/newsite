<?php

namespace Model;

class Page extends \Core\Model
{
    private static $instance;

    public static function app(){
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct(){
        parent::__construct('pages', 'id_page');
    }
    
    public function add($fields){
        $fields['full_url'] = $this->make_full_url($fields['id_parent'], $fields['url']);
        return parent::add($fields);
    }
    
    public function tree($start_level = 0)
	{
		$map = array();		
		$pages = $this->db->select("SELECT * FROM pages 
									WHERE id_parent=:id_parent
									ORDER BY id_page ASC",
                                    ['id_parent' => $start_level]); 
									
		if(!empty($pages))
			foreach($pages as $page)
			{
				$page['children'] = $this->tree($page['id_page']);
				$map[] = $page;
			}
            
		return $map;
	}
    
    private function make_full_url($id_parent, $url){
		if($id_parent == 0)
			return $url;
		
		$page = $this->one($id_parent);
		return $page['full_url'] . '/' .  $url;
	}
}