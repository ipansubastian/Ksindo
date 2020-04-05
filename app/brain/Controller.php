<?php

class Controller
{

    public function view($view, $data = [])
    {
        require_once "../app/views/{$view}.h.php";

        // Tambahkan newline di akhir baris agar view berikutnya tampil di bawah
        echo "\n";
    }

    public function model($model)
    {
        require_once "../app/models/{$model}.php";
        return new $model;
    }
}
