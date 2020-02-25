<?php

require 'vendor/autoload.php';

define('PROJECT_DIR', __DIR__);
define('DB_NAME', 'kusproduct');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PSWD', '');
define('DATA_DUMP_FILE', 'product.json');


require PROJECT_DIR . '/routes.php';