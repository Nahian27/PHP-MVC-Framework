<?php

class Controller
{
    public function model($model)
    {
        require_once __DIR__ . "/../../resources/models/$model.php";
        return new $model();
    }

    public function view($view, array $props = [])
    {
        if (file_exists(__DIR__ . "/../../resources/views/$view.php")) {
            return require_once __DIR__ . "/../../resources/views/$view.php";
        } else {
            return die("View Not Found");
        }
    }
}