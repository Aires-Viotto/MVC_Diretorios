<?php
session_start();
require_once __DIR__.'/../app/vendor/autoload.php';
require_once '../app/config.php';
require_once '../app/routers.php';

$core = new Core\Core();
$core->run();

