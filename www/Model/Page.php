<?php

namespace Model;

class Page extends \Core\Model
{
    private static $instance;

    public static function app()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct()
    {
        parent::__construct('pages', 'id_page');
    }

    public function getByParent($id_parent){
        return $this->db->select("SELECT * FROM {$this->table} WHERE id_parent=:id_parent", ['id_parent' => $id_parent]);
    }

    public function getByUrl($url){
        $res = $this->db->select("SELECT * FROM {$this->table} WHERE full_url=:full_url", ['full_url' => $url]);
        return $res[0];
    }

    public function add($fields)
    {
        $fields['full_url'] = $this->make_full_url($fields['id_parent'], $fields['url']);
        return parent::add($fields);
    }

    public function edit($id, $fields)
    {
        $fields['full_url'] = $this->make_full_url($fields['id_parent'], $fields['url']);
        $res = parent::edit($id, $fields);

        if($res)
            $this->updateChildrenUrl($id);

        return $res;
    }

    public function updateChildrenUrl($id_parent){
        $page = $this->one($id_parent);
        $children = $this->getByParent($id_parent);

        foreach($children as $child){
            $fields = ['full_url' => $page['full_url'] . '/' . $child['url']];
            $this->db->update($this->table, $fields, "id_page={$child['id_page']}");
            $this->updateChildrenUrl($child['id_page']);
        }
    }

    public function tree($start_level = 0)
    {
        $map = [];
        $pages = $this->db->select("SELECT * FROM pages
									WHERE id_parent=:id_parent
									ORDER BY id_page ASC",
            ['id_parent' => $start_level]);

        if (!empty($pages))
            foreach ($pages as $page) {
                $page['children'] = $this->tree($page['id_page']);
                $map[] = $page;
            }

        return $map;
    }

    private function make_full_url($id_parent, $url)
    {
        if ($id_parent == 0)
            return $url;

        $page = $this->one($id_parent);
        return $page['full_url'] . '/' . $url;
    }

    public function delete($id)
    {
        $children  = $this->getByParent($id);

        if ($children != null) {
            return $children;
        } else {
            $res = parent::delete($id);
            return $res;
        }


    }


}