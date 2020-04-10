<?php

/*
 * Kelas model untuk manajemen tema.
 */

class Theme_model extends Bootstrap_theme_model
{

    // Untuk mengimport semua skrip yang dibutuhkan oleh tema.
    public function importThemeScripts()
    {
        $theme_scripts = [];

        // Scan direktori tempat JavaScript disimpan, dan ambil setiap nama file JavaScript.
        foreach (scandir(ROOT_PATH . '/home/themes/' . THEME . '/js/') as $scripts) {
            if (preg_match('/\.js$/', $scripts)) {
                array_push($theme_scripts, $scripts);
            }
        }

        return $theme_scripts;
    }
}
