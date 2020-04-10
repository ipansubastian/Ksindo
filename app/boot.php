<?php

/*
 * Skrip untuk boot / load semua sumber yang dibutuhkan, (Ex: Class, Config, etc.).
 */

require_once 'etc/constants.php';

require_once 'brain/App.php';
require_once 'brain/Controller.php';
require_once 'brain/Database.php';
require_once 'themes/' . THEME . '_theme_model.php';
