<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
    <link rel="stylesheet" href="<?= BASE_URL; ?>/themes/<?= THEME; ?>/theme.css">
</head>

<body>
    <header>
        <div class="container mt-5">
            <h3>Ksindo | Kamus Sunda - Indonesia</h3>
            <nav>
                <nav class="mt-4">
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">

                        <a class="nav-item nav-link <?= $data['is_active']['kamus']; ?>" data-toggle="tab" href="<?= BASE_URL; ?>" role="tab">Kamus</a>

                        <a class="nav-item nav-link <?= $data['is_active']['info-aksara']; ?>" href="<?= BASE_URL; ?>/info/aksara" role="tab">Aksara Sunda</a>

                        <a class="nav-item nav-link <?= $data['is_active']['info-bahasa']; ?>" href="<?= BASE_URL; ?>/info/bahasa" role="tab">Info</a>
                    </div>
                </nav>
            </nav>
        </div>
    </header>