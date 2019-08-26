<?php

require ('../config/dev.php');
require ('../config/Autoloader.php');

use App\config\Autoloader;
use App\config\router;

$autoloader = new Autoloader();
$autoloader->register();
session_start();
$router = new Router();
$router->run();
