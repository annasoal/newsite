<?php

namespace Models;

    class Users extends \Core\Model
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
            parent::__construct('users', 'id_user');
        }
    }
