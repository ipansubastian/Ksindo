<?php

/*
 * Controller Info, Controller yang menangani informasi terkait topik aplikasi.
 */

class Info extends Controller {

    public function index()
    {
        $data = [
            'title' => 'Info',
            'theme_scripts' => $this->model('Theme_model')->importThemeScripts(),
            'is_active' => $this->model('Theme_model')->getActiveTab(__CLASS__, __METHOD__)
        ];

        $this->view('templates/header', $data);
        $this->view('templates/footer', $data);
    }

    public function aksara()
    {
        $data = [
            'title' => 'Aksara Sunda',
            'theme_scripts' => $this->model('Theme_model')->importThemeScripts(),
            'is_active' => $this->model('Theme_model')->getActiveTab(__CLASS__, __METHOD__)
        ];

        $this->view('templates/header', $data);
        $this->view('templates/footer', $data);
    }
}