<?php

require 'vendor/autoload.php';

define('PROJECT_DIR', __DIR__);


$con = new \app\controller\siteController();

$con->index();


