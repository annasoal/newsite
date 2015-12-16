<?php

namespace Model;

class Text extends \Core\Model
{
    private static $instance;

    public static function app()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function __construct(){
        parent::__construct('texts', 'id_text');
    }
}
