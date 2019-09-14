<?php

require ('../config/dev.php');
require ('../vendor/autoload.php');

session_start();
setcookie('pseudo', $_SESSION['name']);
$router = new \App\config\Router();
$router->run();
