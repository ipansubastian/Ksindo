    <?php foreach ($data['theme_scripts'] as $scripts) : ?>
        <script src="<?= BASE_URL; ?>/themes/<?= THEME; ?>/js/<?= $scripts; ?>"></script>
    <?php endforeach; ?>
    <script src="<?= BASE_URL; ?>/engine/engine.js"></script>
    </body>

    </html>