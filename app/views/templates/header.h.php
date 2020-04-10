<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/style/style.css">
    <link rel="stylesheet" href="<?= BASE_URL; ?>/themes/<?= THEME; ?>/theme.css">
</head>

<body>
    <header>
        <div class="container mt-5">
            <h3>Ksindo | Kamus Sunda - Indonesia</h3>
            <div class="setting-button mr-3"></div>
            <nav>
                <nav class="mt-4">
                    <div class="nav nav-tabs <?= $data['is_animated']; ?>" id="nav-tab" role="tablist">

                        <a class="nav-item nav-link <?= $data['is_active']['kamus']; ?>" href="<?= BASE_URL; ?>" role="tab">Kamus</a>

                        <a class="nav-item nav-link <?= $data['is_active']['info-aksara']; ?>" href="<?= BASE_URL; ?>/aksara" role="tab">Aksara Sunda</a>

                        <a class="nav-item nav-link <?= $data['is_active']['info-bahasa']; ?>" href="<?= BASE_URL; ?>/bahasa" role="tab">Bahasa Sunda</a>
                    </div>
                </nav>
            </nav>
        </div>
    </header>