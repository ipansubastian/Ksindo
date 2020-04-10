<?php

class Bootstrap_theme_model
{
    // Berfungsi untuk memilah antara tab yang aktif dan inaktif.
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
        } elseif ($class === 'Aksara') {
            $tabs['info-aksara'] = $active;
        } elseif ($class === 'Bahasa') {
            $tabs['info-bahasa'] = $active;
        }

        return $tabs;
    }
}
