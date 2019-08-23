<?php

require ('../config/dev.php');
require ('../config/Autoloader.php');

use App\config\Autoloader;
use App\config\router;

$autoloader = new Autoloader();
$autoloader->register();

$router = new Router();
$router->run();
