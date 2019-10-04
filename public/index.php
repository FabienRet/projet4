<?php

require ('../config/dev.php');
require ('../vendor/autoload.php');

session_start();
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 60)) {
// last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
    header('Location: ../public/index.php');
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
$router = new \App\config\Router();
$router->run();