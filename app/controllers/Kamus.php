<?php

class Kamus extends Controller
{

    public function index()
    {
        $data = [
            'title' => 'Kamus Sunda - Indonesia'
        ];

        $this->view('templates/header', $data);
        $this->view('kamus/index');
        $this->view('templates/footer');
    }
}
