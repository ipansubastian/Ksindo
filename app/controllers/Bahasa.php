<?php

/*
 * Controller Info, Controller yang menangani informasi terkait topik aplikasi.
 */

class Bahasa extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Info',
            'theme_scripts' => $this->model('Theme_model')->importThemeScripts(),
            'is_active' => $this->model('Theme_model')->getActiveTab(__CLASS__, __METHOD__),
            'is_animated' => 'animated-tabs'
        ];

        $this->view('templates/header', $data);
        $this->view('bahasa/index', $data);
        $this->view('templates/footer', $data);
    }
}
