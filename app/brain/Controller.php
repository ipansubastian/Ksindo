<?php

class Controller
{

    public function view($view, $data = [])
    {
        require_once "../app/views/{$view}.h.php";
        echo "\n";
    }

    public function model($model)
    {
        require_once "../app/models/{$model}.php";
        return new $model;
    }
}
