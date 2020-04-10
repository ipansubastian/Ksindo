<?php

class Aksara extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Aksara Sunda',
            'theme_scripts' => $this->model('Theme_model')->importThemeScripts(),
            'is_active' => $this->model('Theme_model')->getActiveTab(__CLASS__, __METHOD__),
            'is_animated' => 'animated-tabs'

        ];

        $this->view('templates/header', $data);
        $this->view('aksara/index');
        $this->view('templates/footer', $data);
    }
}
