<?php

/*
 * Kelas model untuk manajemen tema.
 */
 
class Theme_model
{

    // Untuk mengimport semua skrip yang dibutuhkan oleh tema.
    public function importThemeScripts()
    {
        $theme_scripts = [];

        foreach (scandir(ROOT_PATH . '/home/themes/' . THEME . '/js/') as $scripts) {
            if (preg_match('/\.js$/', $scripts)) {
                array_push($theme_scripts, $scripts);
            }
        }

        return $theme_scripts;
    }

    // Untuk tema tertentu, berfungsi untuk memilah antara tab yang aktif dan inaktif.
    public function getACtiveTab($class, $method)
    {

        $active = 'text-muted active';
        $inactive = 'text-success';

        $tabs = [
            'kamus' => $inactive,
            'info-aksara' => $inactive,
            'info-bahasa' => $inactive
        ];

        if ($class === 'Kamus') {
            $tabs['kamus'] = $active;
        } elseif ($class === 'Info') {
            if ($method === 'Info::index') {
                $tabs['info-bahasa'] = $active;
            } elseif ($method === 'Info::aksara') {
                $tabs['info-aksara'] = $active;
            }
        }

        return $tabs;
    }

}
