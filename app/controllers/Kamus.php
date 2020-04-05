<?php

/*
 * Controller Kamus ( Controller utama dari aplikasi).
 */

class Kamus extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Kamus Sunda - Indonesia',
            'theme_scripts' => $this->model('Theme_model')->importThemeScripts(),
            'is_active' => $this->model('Theme_model')->getActiveTab(__CLASS__, __METHOD__)
        ];

        $this->view('templates/header', $data);
        $this->view('kamus/index');
        $this->view('templates/footer', $data);
    }

}
