<?php 
require_once dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'autoload.php';

use App\Controller\AuthController;

(new AuthController())->logout();
require_once dirname(__DIR__) . DS . 'Elements' . DS . 'header.php';

?>