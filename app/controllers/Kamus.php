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
            'is_active' => $this->model('Theme_model')->getActiveTab(__CLASS__, __METHOD__),
            'is_animated' => 'animated-tabs'
        ];

        $this->view('templates/header', $data);
        $this->view('kamus/index');
        $this->view('templates/footer', $data);
    }

    public function vocabularies()
    {
        // print_r($_GET);

        $daftar_kosakata = $this->model('Kamus_model')->selectVocabularies($_POST);
        print_r($daftar_kosakata);
        // echo json_encode($this->model('Kamus_model')->selectVocabularies($_POST));
    }

    public function mean()
    {
        $arti_kata = $this->model('Kamus_model')->getVocabularyMean($_POST);
        print_r($arti_kata);
    }
}
