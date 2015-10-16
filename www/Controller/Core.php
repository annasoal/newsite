<?php

namespace Controller;

abstract class Core
{
    protected $params;

    abstract function render();

    public function request($action, $params = [])
    {
        $this->params = $params;
        $this->$action();
        $this->render();
    }

    public function __call($name, $params)
    {
        throw new \Exception('Класс не найден');
    }

}