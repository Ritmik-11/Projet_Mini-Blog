<?php

class Controller
{
    public function render($view, $data = [])
    {
        extract($data);
        require "../app/views/{$view}.php";
    }

    public function redirect($url)
    {
        header("Location: $url");
        exit;
    }
}
