<?php

require_once __DIR__ . '/config/config.php';

spl_autoload_register(function ($className) {
    require_once __DIR__ . "/libraries/$className.php";
});