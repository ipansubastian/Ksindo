<?php

class App
{

    private
        $controller = 'Kamus',
        $method = 'index',
        $params = [];

    public function __construct()
    {
        $url = $this->parseURL();


        // Controller

        /*
         * Untuk menghindari Controller tak ditemukan di sistem yang pembacaan filenya case-sensitive (Contoh: Linux).
         * Karena itu huruf pertama dari nama controller harus berupa huruf kapital.
         */

        $tmp_controller = ucfirst($url[0]);

        if (file_exists("../app/controllers/{$tmp_controller}.php")) {
            $this->controller = $tmp_controller;
            unset($url[0]);
        }

        require_once "../app/controllers/{$this->controller}.php";
        $this->controller = new $this->controller;


        // Method

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }


        // Parameter

        if (!empty($url)) {
            $this->params = $url;
        }


        // Eksekusi Controller, Method, dan Parameter

        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    /*
     * Fungsi untuk parse URL kedalam array.
     */

    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = trim('/', $_GET['url']);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
