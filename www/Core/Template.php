<?php

namespace Core;

class Template
{
    public static function all($type)
    {
        $folder = ($type == 'inner') ? 'inner_templates' : 'base_templates';
        
        $files = scandir('View/client/' . $folder);
        $templates = [];
        
        foreach($files as $f)
            if($f != '.' && $f != '..')
                $templates[] = $f;
                
        return $templates;
    }
}
